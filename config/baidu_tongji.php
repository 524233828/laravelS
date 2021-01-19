<?php
return [

    'refresh_token' => env("BDTJ_REFRESH_TOKEN", ""),

    'client_id' => env("BDTJ_CLIENT_ID", ""),

    'client_secret' => env("BDTJ_CLIENT_SECRET", ""),

    /**
     * 统计用户仅支持如下账户类型：
     * 1：站长账号
     * 2：凤巢账号
     * 3：联盟账号
     * 4：哥伦布账号
     */
    'account_type' => 1,
];
