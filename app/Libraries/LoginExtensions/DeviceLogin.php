<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-05-04
 * Time: 21:15
 */

namespace App\Libraries\LoginExtensions;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use JoseChan\UserLogin\Handler\LoginAbstract;

class DeviceLogin extends LoginAbstract
{

    protected $auto_register = true;
    public function login(array $form): Model
    {
        $my_user = User::query()->where("openid", "=", $form['device_no'])->where("openid_type", "=", 1)->first();
        if(!$my_user){
            $my_user = new User();
            $my_user->exists = false;
        }
        return $my_user;
    }

    public function register(array $form): Model
    {
        $userInfo = [];
        $data = [
            "openid" => $form['device_no'],
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
            "openid_type" => 1,
        ];

        if (!empty($data) && isset($data['openid']) && !empty($data['openid'])) {
            $my_user = new User($data);
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

    public function loginValidate(): array
    {
        return [
            "device_no" => "required"
        ];
    }

    public function registerValidate(): array
    {
        return [];
    }

}
