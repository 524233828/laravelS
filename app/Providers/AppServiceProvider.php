<?php

namespace App\Providers;

use App\Libraries\LoginExtensions\DeviceLogin;
use App\Libraries\LoginExtensions\WechatLogin;
use Illuminate\Support\ServiceProvider;
use JoseChan\UserLogin\Handler\Login;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
