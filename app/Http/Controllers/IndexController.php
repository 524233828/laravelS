<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/11/21
 * Time: 10:22
 */

namespace App\Http\Controllers;


use App\Api\Logic\CommonLogic;
use App\Models\Card;
use App\Models\Statistic;
use App\Models\UserCard;
use App\Services\BaiduService;
use EasyWeChat\Factory;
use FormBuilder\Factory\Elm;
use FormBuilder\Form;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use JoseChan\App\Sdk\AppSdk;
use JoseChan\Base\Sdk\BaseSdk;
use JoseChan\Websocket\Websocket;
use Swoole\Server;

class IndexController extends Controller
{

    protected $config = [
        'debug'  => true,
        'app_id'  => 'wx6443795c16bf53ba',         // AppID
        'secret'  => '4c774350e2330a277417dbb3c91ee132',     // AppSecret
        'log' => [
            'level'      => 'debug',
            'permission' => 0777,
            'file'       => '../runtime/logs/easywechat.log',
        ],

        'oauth' => [
            'scopes'   => ['snsapi_base'],
            'callback' => '/oath/callback',
        ],
    ];

    public function index(Request $request)
    {


//        $message = json_decode('{"appid":"wxb4a8c2a673c2a71f","bank_type":"OTHERS","cash_fee":"10","fee_type":"CNY","is_subscribe":"Y","mch_id":"1537381241","nonce_str":"5e8fcd37629af","openid":"oy_y95hWIibVH9mPw4OX5-kcLWA4","out_trade_no":"15864824853061","result_code":"SUCCESS","return_code":"SUCCESS","sign":"B15502A215D1302F974F431050FBFA63","sign_type":"MD5","time_end":"20200410093451","total_fee":"10","trade_type":"JSAPI","transaction_id":"4200000544202004102367537253"}', true);
//        \App\Api\Logic\CommonLogic::orderNotify($message, function ($notify){
//            echo $notify;
//        });
//        exit;
//        exit;
//        $app_sdk = app()->make(AppSdk::class);
//
//        $response = $app_sdk->getToken(1, "aaaaaaaa");
//
//        echo $response->getBody()->getContents();exit;

        //没有微信ID，静默授权
        if( null === $wxid = $request->get("wxid")){
            return $this->wxOauth();
        }

        $model = new UserCard();
        $user_card = $model->where(["openid" => $wxid])->first();

        if(!$user_card)
        {
            $is_get_card = 0;
            $card = Card::where(["is_default"=> 1])->get();
            $card_array = $card->toArray()[0];
        }else{

            $is_get_card = 1;
            $user_card_array = $user_card->toArray();

            $card = Card::find($user_card_array['card_id']);
            $card_array = $card->toArray();
        }

        $data = [
            "image_url" => $card_array['image_url'],
            "card_no" => isset($user_card_array['card_no']) ? $user_card_array['card_no'] : "",
            "score" => isset($user_card_array['score']) ? $user_card_array['score'] : 0,
            "is_get_card"=>$is_get_card,
            "wxid" => $wxid
        ];

        return view("index", $data);
    }

    public function wxOauth()
    {

        $app = Factory::officialAccount($this->config);

        $oauth = $app->oauth;

        return $oauth->redirect();
    }

    public function oauthCallback()
    {
        $app = Factory::officialAccount($this->config);

        $oauth = $app->oauth;

        $user = $oauth->user();

//        redirect();

    }


}