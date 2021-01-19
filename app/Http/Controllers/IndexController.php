<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/11/21
 * Time: 10:22
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Swoole\Server;

class IndexController extends Controller
{

//    protected $config = [
//        'debug'  => true,
//        'app_id'  => 'wx6443795c16bf53ba',         // AppID
//        'secret'  => '4c774350e2330a277417dbb3c91ee132',     // AppSecret
//        'log' => [
//            'level'      => 'debug',
//            'permission' => 0777,
//            'file'       => '../runtime/logs/easywechat.log',
//        ],
//
//        'oauth' => [
//            'scopes'   => ['snsapi_base'],
//            'callback' => '/oath/callback',
//        ],
//    ];

    public function index(Request $request)
    {

        return view("welcome");
    }
}