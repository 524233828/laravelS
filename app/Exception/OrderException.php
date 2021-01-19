<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2017/11/19
 * Time: 0:00
 */

namespace App\Exception;

use App\Constant\ErrorCode;

class OrderException extends BaseException
{
    public static function OrderCreateFail()
    {
        throw new self(
            ErrorCode::msg(ErrorCode::ORDER_CREATE_FAIL),
            ErrorCode::ORDER_CREATE_FAIL
        );
    }

    public static function OrderNotFound()
    {
        throw new self(
            ErrorCode::msg(ErrorCode::ORDER_NOT_FOUND),
            ErrorCode::ORDER_NOT_FOUND
        );
    }

    public static function OrderExtraAddAlready()
    {
        throw new self(
            ErrorCode::msg(ErrorCode::ORDER_EXTRA_ADD_ALREADY),
            ErrorCode::ORDER_EXTRA_ADD_ALREADY
        );
    }

    public static function OrderNotPaid()
    {
        throw new self(
            ErrorCode::msg(ErrorCode::ORDER_NOT_PAID),
            ErrorCode::ORDER_NOT_PAID
        );
    }
}