<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/6/14
 * Time: 10:44
 */

namespace Helper\Forecast\Validator;

use Illuminate\Http\Request;

class GuanYinLingQianValidator implements ValidatorInterface
{

    public static function validate(Request $request)
    {
        return ValidatorHelper::validator($request->all(), [
            "qian" => "required|integer|min:1|max:100",
        ]);
    }

    public static function toParams($extra)
    {
        return $extra;
    }

}