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
    public static function register()
    {
        //读取服务域名及监听的端口
        $app_name = env("APP_NAME", "helloWorld");
        $server_host = env("LARAVELS_LISTEN_IP", "127.0.0.1") . ":" . env("LARAVELS_LISTEN_PORT". 5200);
        if (empty($app_name)) {
            return false;
        }

        global $client;

        //链接zookeeper
        $client = new \Zookeeper("localhost:2181");
        //将客户端设置为全局变量，不会销毁关闭

        $acls = [
            [
                'perms' => \Zookeeper::PERM_ALL,
                'scheme' => 'world',
                'id' => 'anyone'
            ]
        ];

        $client->create("/{$app_name}/{$server_host}", "1", $acls, \Zookeeper::EPHEMERAL);

    }

    //服务发现
    public static function discover()
    {

    }
}
