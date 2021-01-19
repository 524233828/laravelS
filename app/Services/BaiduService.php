<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-04-08
 * Time: 17:59
 */

namespace App\Services;

use GuzzleHttp\Client;

class BaiduService
{
    private $http;

    private $uri;

    const DOMAIN = "https://sp0.baidu.com";

    public function __construct()
    {
        $this->http = new Client();

        $this->uri = new Uri(self::DOMAIN);
    }

    /**
     * 百度获取汇率，计算金额转换
     * @param $query
     * @return mixed
     */
    public function exchangeMoney($query)
    {
        $data = [
            "query" => $query,
            "resource_id" => 5293
        ];

        $uri = clone $this->uri;

        $uri->withPath("/8aQDcjqpAAV3otqbppnN2DJv/api.php");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 格式化汇率查询语句
     * @param $from_currency
     * @param $to_currency
     * @param $amount
     * @return string
     */
    public function formatMoneyQuery($from_currency, $to_currency, $amount)
    {
        $query = "%s%s等于多少%s";
        return sprintf($query, (string)$amount, $from_currency, $to_currency);
    }

}
