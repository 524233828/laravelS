<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-02-29
 * Time: 12:33
 */

namespace App\Providers;


use EasyWeChat\Factory;
use Illuminate\Support\ServiceProvider;

class WechatServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $wechat = config("wechat.payment");
        $this->app->bind("wechat_payment", function ($app) use ($wechat) {
            return Factory::payment($wechat);
        });

        $wechat = config("wechat.app");
        $this->app->bind("wechat", function ($app) use ($wechat) {
            return Factory::officialAccount($wechat);
        });
    }
}
