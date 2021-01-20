<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2021-01-20
 * Time: 17:44
 */

namespace Helper;


use Swoole\IDEHelper\StubGenerators\SwooleZookeeper;

class ServiceHandler
{
    //服务注册
    public function register()
    {
        //读取服务域名及监听的端口
        $app_name = env("APP_URL");
        $server_host = env('LARAVELS_LISTEN_IP', '127.0.0.1') . ":" . env('LARAVELS_LISTEN_PORT', 5200);
        if (empty($app_name)) {
            return false;
        }

        //链接zookeeper
        $client = new \Zookeeper("localhost:2181");

        $client->create("/service/{$app_name}/{$server_host}", 1, [], \Zookeeper::EPHEMERAL);
    }

    //服务发现
    public function discover()
    {

    }
}
