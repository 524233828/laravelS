<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-05-04
 * Time: 16:24
 */

namespace App\Libraries\LoginExtensions;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;
use JoseChan\UserLogin\Constant\ErrorCode;
use JoseChan\UserLogin\Handler\LoginAbstract;

class WechatLogin extends LoginAbstract
{

    protected $auto_register = true;

    protected $user_data = [];

    public function login(array $form): Model
    {
        $log = myLog("login");
        $log->addDebug("开始授权获取用户信息");
        $oauth = wechat()->oauth;

        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        $log->addDebug("用户对象：" . serialize($user));

        $wechat_user = $user->toArray();
        $log->addDebug("授权对象：" . json_encode($wechat_user));
        $scope = $wechat_user['original']['scope'];
        $openid = $wechat_user['id'];
        if ($scope == "snsapi_userinfo") {
            $userInfo = $wechat_user['original'];
            $data = [
                "openid" => $userInfo['openid'],
                "subscribe" => 1,
                "nickname" => $userInfo['nickname'],
                "sex" => $userInfo['sex'],
                "language" => $userInfo['language'],
                "city" => $userInfo['city'],
                "country" => $userInfo['country'],
                "province" => $userInfo['province'],
                "headimgurl" => $userInfo['headimgurl'],
                "subscribe_time" => time(),
                "unionid" => isset($userInfo['unionid']) ? $userInfo['unionid'] : "",
                "remark" => "",
                "groupid" => "",
                "channel_id" => isset($_SESSION['channel']) ? $_SESSION['channel'] : 1,
                "openid_type" => 0,
            ];
        } else {
            $userService = wechat()->user;
            $userInfo = $userService->get($openid);
            $data = [
                "openid" => $userInfo['openid'],
                "subscribe" => isset($userInfo['subscribe']) ? $userInfo['subscribe'] : 0,
                "nickname" => isset($userInfo['nickname']) ? $userInfo['nickname'] : "微信用户" . time(),
                "sex" => isset($userInfo['sex']) ? $userInfo['sex'] : 0,
                "language" => isset($userInfo['language']) ? $userInfo['language'] : "未知",
                "city" => isset($userInfo['city']) ? $userInfo['city'] : "未知",
                "country" => isset($userInfo['country']) ? $userInfo['country'] : "未知",
                "province" => isset($userInfo['province']) ? $userInfo['province'] : "未知",
                "headimgurl" => isset($userInfo['headimgurl']) ? $userInfo['headimgurl'] : "http://www.ym8800.com/static/img/preson.f518f1a.png",
                "subscribe_time" => isset($userInfo['subscribe_time']) ? $userInfo['subscribe_time'] : time(),
                "unionid" => isset($userInfo['unionid']) ? $userInfo['unionid'] : "",
                "remark" => isset($userInfo['remark']) ? $userInfo['remark'] : "",
                "groupid" => isset($userInfo['groupid']) ? $userInfo['groupid'] : 0,
                "channel_id" => isset($_SESSION['channel']) ? $_SESSION['channel'] : 1,
                "openid_type" => 0,
            ];
        }

        $this->user_data = $data;
        $log->addDebug("用户信息：" . json_encode($data));
        $my_user = User::query()->where("openid", "=", $openid)->first();
        if(!$my_user){
            $my_user = new User();
            $my_user->exists = false;
        }
        return $my_user;
    }

    public function register(array $form): Model
    {
        $form = array_merge($form, $this->user_data);
        if (!empty($form) && isset($form['openid']) && !empty($form['openid'])) {
            $my_user = new User($form);
            $my_user->save();
        } else {
            $my_user = new User();
            $my_user->exists = false;
        }

        return $my_user;
    }

    public function userInfo(): Model
    {
        // TODO: Implement userInfo() method.
    }

    public function failsRegisterHandler(): Response
    {
        return \response()->json([
            "code" => ErrorCode::REGISTER_FAIL,
            "msg" => ErrorCode::msg(ErrorCode::REGISTER_FAIL),
            "data" => [],
        ]);
    }

    public function failsLoginHandler(): Response
    {
        return \response()->json([
            "code" => ErrorCode::LOGIN_FAIL,
            "msg" => ErrorCode::msg(ErrorCode::LOGIN_FAIL),
            "data" => [],
        ]);
    }

    public function successRegisterHandler(Model $user): Response
    {
        /** @var User $user */
        return \response()->json([
            "code" => 1,
            "msg" => "success",
            "data" => [
                "token" => $this->generateJWT($user->id)
            ],
        ]);
    }

    public function successLoginHandler(Model $user): Response
    {
        /** @var User $user */
        return \response()->json([
            "code" => 1,
            "msg" => "success",
            "data" => [
                "token" => $this->generateJWT($user->id)
            ],
        ]);
    }

    public function loginValidate(): array
    {
        return [
            "code" => "required",
        ];
    }

    public function registerValidate(): array
    {
        return [];
    }
}
