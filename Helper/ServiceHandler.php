<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2021-01-20
 * Time: 17:44
 */

namespace Helper;

class ServiceHandler
{
    //服务注册
    public static function register()
    {
        //读取服务域名及监听的端口
        $app_name = self::getConfigByKey("APP_NAME", "helloWorld");
        $server_host = self::getConfigByKey("LARAVELS_LISTEN_IP", "127.0.0.1") . ":" . self::getConfigByKey("LARAVELS_LISTEN_PORT", 5200);
        if (empty($app_name)) {
            return false;
        }

        //将客户端设置为全局变量，不会销毁关闭
        global $client;

        //链接zookeeper
        $client = new \Zookeeper("localhost:2181");

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

    public static function getConfig()
    {
        return unserialize((string)file_get_contents($this->getConfPath()));
    }

    protected static function getConfPath()
    {
        return realpath(__DIR__ . '/../') . '/storage/laravels.conf';
    }

    public static function getConfigByKey($key, $default)
    {
        $config = self::getConfig();

        $config = $config['laravel'];

        if (isset($config[$key])) {
            return $config[$key];
        }

        return $default;
    }

}
