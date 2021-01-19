<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Event::listen('laravels.received_request', function (\Illuminate\Http\Request $req, $app) {
            echo "接收请求；\n";
            //创建sentinel 客户端
            $sentinel = new \Sentinel\SentinelClient(env('SENTINEL_HOST', 'localhost'), env('SENTINEL_PORT', '9000'));
            try {
                $sentinelHelloEntry = $sentinel->entry("hello");
            } catch (\Sentinel\BlockException $e) {
                $sentinelHelloEntry = null;
                throw $e;
            } finally {
                $sentinelHelloEntry = null;
            }
        });
        //
    }
}
