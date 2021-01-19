<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/7/30
 * Time: 17:45
 */

namespace App\Services;


class PayService
{

    const WECHAT_OFFICIAL = 'wechat_official';

    const WECHAT_H5   = 'wechat_h5';
    const WECHAT_MWEB = 'wechat_mweb';
    const WECHAT_APP = 'wechat_app';

    const ALI_PAY_APP = 'alipay_app';


    public static $gateway = [
        self::WECHAT_H5       => "MWEB",
        self::WECHAT_OFFICIAL => "JSAPI"
    ];
}