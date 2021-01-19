<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2017/11/18
 * Time: 13:31
 */

namespace App\Constant;

use Illuminate\Http\Response;

/**
 * 错误码，除1处理成功，负数的基本错误外，其余错误码均为4位数字，区别于3位的HTTP状态码
 * Class ErrorCode
 * @package Constant
 */

class ErrorCode
{
    const OK = 1;  //处理成功

    const ERR_SYSTEM = -1; //系统错误
    const ERR_OVERTIME = -2; // 请求超时
    const ERR_INVALID_PARAMETER = -4; //请求参数错误
    const ERR_CHECK_SIGN = -5; //签名验证错误
    const ERR_NO_PARAMETERS = -6; //参数缺失
    const ERR_UNKNOWN = -7; // 未知错误
    const AUTHORIZATION_FAIL = -8;//无权限查看

    /**
     * 10xx用户系统错误
     */
    const USER_NOT_LOGIN = 1000; // 未登录
    const USER_NOT_EXISTS = 1001; // 用户不存在
    const LOGIN_FAIL = 1002; //登录失败

    /**
     * 12xx订单系统错误
     */
    const ORDER_CREATE_FAIL = 1200;//订单创建失败
    const ORDER_NOT_FOUND = 1201;//订单创建失败
    const ORDER_EXTRA_ADD_ALREADY = 1202;//订单创建失败
    const ORDER_NOT_PAID = 1203;//订单未付款

    /**
     * 13xx订单系统错误
     */
    const FORECAST_PRICE_ERR = 1300;//测算价格不存在
    const FORECAST_CHANNEL_EXIST = 1301;

    /**
     * 14xx 文章系统错误
     */
    const CHAPTER_NOT_FOUND = 1400;

    const COLLECT_FAIL = 1500;
    const COLLECT_ALREADY = 1501;
    const COLLECT_NOT_FOUND = 1502;
    const CANCEL_FAIL = 1503;


    /**
     * 错误代码与消息的对应数组
     *
     * @var array
     */
    static public $msg = [
        self::OK                    => ['处理成功', Response::HTTP_OK],
        self::ERR_SYSTEM            => ['系统错误', Response::HTTP_INTERNAL_SERVER_ERROR],
        self::ERR_INVALID_PARAMETER => ['请求参数错误', Response::HTTP_BAD_REQUEST],
        self::ERR_CHECK_SIGN        => ['签名错误', Response::HTTP_FORBIDDEN],
        self::ERR_NO_PARAMETERS     => ['参数缺失', Response::HTTP_BAD_REQUEST],
        self::ERR_OVERTIME          => ['请求超时', Response::HTTP_BAD_REQUEST],

        //用户系统错误
        self::USER_NOT_LOGIN        => ['未登录', Response::HTTP_FORBIDDEN],
        self::USER_NOT_EXISTS       => ['用户名或密码错误', Response::HTTP_FORBIDDEN],
        self::LOGIN_FAIL            => ['登录失败', Response::HTTP_BAD_GATEWAY],

        //订单系统错误
        self::ORDER_CREATE_FAIL     => ['生成订单失败', Response::HTTP_BAD_GATEWAY],
        self::ORDER_NOT_FOUND     => ['订单不存在', Response::HTTP_NOT_FOUND],
        self::ORDER_EXTRA_ADD_ALREADY     => ['发单信息已添加', Response::HTTP_FORBIDDEN],
        self::ORDER_NOT_PAID     => ['订单未付款', Response::HTTP_FORBIDDEN],

        //测算系统错误
        self::FORECAST_PRICE_ERR     => ['测算价格错误', Response::HTTP_BAD_GATEWAY],
        self::FORECAST_CHANNEL_EXIST     => ['渠道测算价格已存在', Response::HTTP_BAD_GATEWAY],
        self::COLLECT_FAIL     => ['收藏失败', Response::HTTP_BAD_GATEWAY],
        self::COLLECT_ALREADY     => ['已收藏', Response::HTTP_BAD_GATEWAY],
        self::COLLECT_NOT_FOUND     => ['收藏不存在', Response::HTTP_BAD_GATEWAY],
        self::CANCEL_FAIL     => ['取消失败', Response::HTTP_BAD_GATEWAY],

        //文章系统错误
        self::CHAPTER_NOT_FOUND => ['文章不存在', Response::HTTP_NOT_FOUND],

        self::AUTHORIZATION_FAIL     => ['无权限查看', Response::HTTP_FORBIDDEN],

    ];

    /**
     * 返回错误代码的描述信息
     *
     * @param int    $code        错误代码
     * @param string $otherErrMsg 其他错误时的错误描述
     * @return string 错误代码的描述信息
     */
    public static function msg($code, $otherErrMsg = '')
    {
        if ($code == self::ERR_UNKNOWN) {
            return $otherErrMsg;
        }

        if (isset(self::$msg[$code][0])) {
            return self::$msg[$code][0];
        }

        return $otherErrMsg;
    }

    /**
     * 返回错误代码的Http状态码
     * @param int $code
     * @param int $default
     * @return int
     */
    public static function status($code, $default = 200)
    {
        if ($code == self::ERR_UNKNOWN) {
            return $default;
        }

        if (isset(self::$msg[$code][1])) {
            return self::$msg[$code][1];
        }

        return $default;
    }

    public static function getCode($code)
    {
        return isset(self::$msg[$code])?self::$msg[$code]:false;
    }
}
