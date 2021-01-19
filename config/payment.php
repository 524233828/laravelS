<?php
return [
    // 微信支付参数
    'wechat' => [
        'debug'      => false, // 沙箱模式
        'app_id'     => '', // 应用ID
        'mch_id'     => '', // 微信支付商户号
        'mch_key'    => '', // 微信支付密钥
        'ssl_cer'    => '', // 微信证书 cert 文件
        'ssl_key'    => '', // 微信证书 key 文件
        'notify_url' => '', // 支付通知URL
        'cache_path' => '',// 缓存目录配置（沙箱模式需要用到）
    ],

    "alipay_wap" => [
        'app_id'      => env("ALI_WAP_APP_ID", ""), // 应用ID
        'alipay_public_key'  => "-----BEGIN PUBLIC KEY-----\n".env("ALI_WAP_PUBLIC_KEY", "")."\n-----END PUBLIC KEY-----",
        'app_private_key' => "-----BEGIN RSA PRIVATE KEY-----\n".env("ALI_WAP_PRIVATE_KEY", "")."\n-----END RSA PRIVATE KEY-----",
        'notify_url'  => env("APP_URL").'/api/comm/ali_notify', // 支付通知URL
    ],

    "alipay_app" => [
        'app_id'      => env("ALI_APP_APP_ID", ""), // 应用ID
        'alipay_public_key'  => "-----BEGIN PUBLIC KEY-----\n".env("ALI_APP_PUBLIC_KEY", "")."\n-----END PUBLIC KEY-----",
        'app_private_key' => "-----BEGIN RSA PRIVATE KEY-----\n".env("ALI_APP_PRIVATE_KEY", "")."\n-----END RSA PRIVATE KEY-----",
        'notify_url'  => env("APP_URL").'/api/comm/ali_notify', // 支付通知URL
    ],

    "alipay_app_names" => [
        'pay_type'      => "alipay_app", // 应用ID
        'app_id'      => env("ALI_APP_NAME_APP_ID", ""), // 应用ID
        'alipay_public_key'  => "-----BEGIN PUBLIC KEY-----\n".env("ALI_APP_NAME_PUBLIC_KEY", "")."\n-----END PUBLIC KEY-----",
        'app_private_key' => "-----BEGIN RSA PRIVATE KEY-----\n".env("ALI_APP_NAME_PRIVATE_KEY", "")."\n-----END RSA PRIVATE KEY-----",
        'notify_url'  => env("APP_URL").'/api/comm/ali_notify', // 支付通知URL
    ],

    "wechat_h5" => [
        'app_id'     => env("WECHAT_APP_ID", ""), // 应用ID
        'app_secret' => env("WECHAT_APP_SECRET", ""), // 应用ID
        'mch_id'     => env("WECHAT_MCH_ID", ""), // 微信支付商户号
        'mch_secret' => env("WECHAT_MCH_SECRET", ""), // 微信支付密钥
        "notify_url" => env("APP_URL").'/api/comm/order_notify',
        "site_url" => env("APP_URL"),
        "site_name" => "宝宝起名"
    ],

    "wechat_official" => [
        'app_id'     => env("WECHAT_APP_ID", ""), // 应用ID
        'app_secret'     => env("WECHAT_APP_SECRET", ""), // 应用ID
        'mch_id'     => env("WECHAT_MCH_ID", ""), // 微信支付商户号
        'mch_secret' => env("WECHAT_MCH_SECRET", ""), // 微信支付密钥
        "notify_url" => env("APP_URL").'/api/comm/order_notify'
    ],

    "wechat_app" => [
        'app_id'     => env("WECHAT_APP_ID", ""), // 应用ID
        'app_secret' => env("WECHAT_APP_SECRET", ""), // 应用ID
        'mch_id'     => env("WECHAT_MCH_ID", ""), // 微信支付商户号
        'mch_secret' => env("WECHAT_MCH_SECRET", ""), // 微信支付密钥
        "notify_url" => env("APP_URL").'/api/comm/order_notify',
        "site_url" => env("APP_URL"),
        "site_name" => "宝宝起名"
    ],
];