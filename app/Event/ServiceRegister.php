<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2021-01-21
 * Time: 15:10
 */

namespace App\Event;


use Helper\ServiceHandler;
use Hhxsv5\LaravelS\Swoole\Events\ServerStartInterface;
use Swoole\Http\Server;

class ServiceRegister implements ServerStartInterface
{

    public function handle(Server $server)
    {
        //服务注册
        ServiceHandler::register();
    }

    public function __construct()
    {
    }
}
