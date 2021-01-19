<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/5/12
 * Time: 14:48
 */

namespace App\Exception;


use App\Constant\ErrorCode;

class ForecastException extends BaseException
{

    public static function forecastPriceError(){
        throw new self(
            ErrorCode::msg(ErrorCode::FORECAST_PRICE_ERR),
            ErrorCode::FORECAST_PRICE_ERR
        );
    }

    public static function forecastChannelExist(){
        throw new self(
            ErrorCode::msg(ErrorCode::FORECAST_CHANNEL_EXIST),
            ErrorCode::FORECAST_CHANNEL_EXIST
        );
    }
}