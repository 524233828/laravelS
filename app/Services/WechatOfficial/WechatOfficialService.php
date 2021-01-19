<?php

/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019/1/18
 * Time: 11:10
 */

namespace App\Services\WechatOfficial;

use App\Models\WechatMenu;
use App\Models\WechatMenuConfig;
use App\Models\WechatMenuType;
use App\Models\WechatOfficialAccount;
use App\Services\WechatOfficial\Constant\UserEventType;
use App\Services\WechatOfficial\Replier\MainReplier;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Cache\Simple\RedisCache;
use EasyWeChat\Factory;
use Illuminate\Support\Facades\Redis;

class WechatOfficialService
{
    public function getAccessToken($wx_app_id = "")
    {

        $app = $this->getApp($wx_app_id);

        $token = $app->access_token->getToken();

        return $token['access_token'];

    }

    /**
     * 获取应用
     * @param string $wx_app_id
     * @return bool|\EasyWeChat\OfficialAccount\Application
     * @throws \Exception
     */
    protected function getApp($wx_app_id = "")
    {
        if(empty($wx_app_id)){
            return false;
        }

        $where = [];

        $where['wx_app_id'] = $wx_app_id;

        $account = WechatOfficialAccount::where($where)->first();

        $config = [
            "app_id" => $account->wx_app_id,
            "secret" => $account->app_secret,
            "token" => $account->token,
            "aes_key" => $account->aes_key,
        ];

        $app = Factory::officialAccount($config);

//        $redis = Redis::connection("default")->client();
//        $cache = new RedisCache($redis);
//        $app->access_token->setCache($cache);
        $cache = new RedisAdapter(app('redis')->connection()->client());
        $app->rebind('cache', $cache);

        return $app;
    }

    /**
     * 创建菜单
     * @param $wx_app_id
     * @return mixed
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function createMenu($wx_app_id)
    {
        //获取所有菜单
        $wechat_menus = WechatMenu::where(["wx_app_id"=> $wx_app_id, "status" => 1])->get()->toArray();
        
        $menu_id = [];
        $type_id = [];
        foreach ($wechat_menus as $wechat_menu)
        {
            $menu_id[] = $wechat_menu['id'];
            $type_id[] = $wechat_menu['type'];
        }

        //组装菜单配置
        $menu_configs = WechatMenuConfig::whereIn("menu_id", $menu_id)->get()->toArray();

        $config = [];
        foreach ($menu_configs as $menu_config)
        {
            $config[$menu_config['menu_id']][$menu_config['key']] = $menu_config['value'];
        }

        //获取菜单类型
        $menu_types = WechatMenuType::whereIn("id", $type_id)->get()->toArray();
        $type_index = [];
        foreach ($menu_types as $menu_type)
        {
            $type_index[$menu_type['id']] = $menu_type['tag'];
        }

        $menu = [];
        foreach ($wechat_menus as $wechat_menu)
        {
            $unit = [];
            if(!empty($type_index[$wechat_menu['type']]))
            {
                $unit['type'] = $type_index[$wechat_menu['type']];
            }
            $unit['name'] = $wechat_menu['name'];

            if(isset($config[$wechat_menu['id']])){
                foreach ($config[$wechat_menu['id']] as $key => $value)
                {
                    $unit[$key] = $value;
                }
            }

            if($wechat_menu['parent_id'] != 0 )
            {
                isset($menu[$wechat_menu['parent_id']]['sub_button']) ?
                    array_push($menu[$wechat_menu['parent_id']]['sub_button'], $unit) :
                    $menu[$wechat_menu['parent_id']]['sub_button'][] = $unit;
            }else{
                $menu[$wechat_menu['id']] = $unit;
            }
        }

        $menu = array_values($menu);
        $response = $this->getApp($wx_app_id)->menu->create($menu);
        return $response;
    }

    /**
     * 获取响应消息
     * @param string $wx_app_id 公众号app_id
     * @param null|\Closure $handler 回调函数
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \EasyWeChat\Kernel\Exceptions\BadRequestException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \ReflectionException
     */
    public function handleEvent($wx_app_id, $handler = null)
    {
        $app = $this->getApp($wx_app_id);

        $app->server->push($handler);

        return $app->server->serve();
    }

    /**
     * 发送客服消息
     * @param $wx_app_id
     * @param $type
     * @param $params
     * @param $to
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \Exception
     */
    public function sendCustom($wx_app_id, $type, $params, $to)
    {
        $log = myLog("service");
        $app = $this->getApp($wx_app_id);
        $log->addDebug("app_id". $wx_app_id);
        $log->addDebug("app". json_encode($app));
        $replier = new MainReplier();

        return $replier->send($app, $params, $type, $to);
    }

    /**
     * 获取发信者
     * @param $type
     * @param $params
     * @return mixed
     */
    public function getReplied($type, $params)
    {
        $replier = new MainReplier();

        return $replier->getReplied($params, $type);
    }
    
}