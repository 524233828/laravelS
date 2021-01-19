<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019-11-22
 * Time: 10:36
 */

namespace App\Providers;


use App\Services\OssClientService;
use Illuminate\Support\ServiceProvider;
use OSS\OssClient;

class OssClientServiceProvider extends ServiceProvider
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
        //
        $this->app->singleton(OssClientService::class, function($app){

            return new OssClientService();

        });
    }
}
