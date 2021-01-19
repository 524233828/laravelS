<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-04-24
 * Time: 10:27
 */

namespace App\Console\Commands;


use Illuminate\Console\Command;
use JoseChan\Websocket\Websocket;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class WebSocketServer extends Command
{
    protected $signature = 'swoole:websocket';
    /**
     * 执行控制台命令。
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            /** @var Websocket $websocket */
            $websocket = app()->make(Websocket::class);
            $websocket->options()->daemonize = 1;

            $websocket->event()->start(function (Server $server){
                echo "server start";
            });

            $websocket->event()->message(function (\Swoole\WebSocket\Server $server, Frame $frame){
                echo "receive message";
            });

            $websocket->start();
        }catch (\Exception $e){
            echo $e->getMessage();
        }

    }
}
