<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/6/14
 * Time: 10:44
 */

namespace Helper\Forecast\Validator;


use Illuminate\Http\Request;

class BaseValidator implements ValidatorInterface
{

    public static function validate(Request $request)
    {
        return ValidatorHelper::validator($request->all(), [
            "name" => "required",
            "gender" => "required|in:male,female",
            "birthday" => "required",
        ]);
    }

    public static function toParams($extra)
    {
        return $extra;
    }

}