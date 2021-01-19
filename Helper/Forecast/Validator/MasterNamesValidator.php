<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-05-19
 * Time: 09:21
 */

namespace Helper\Forecast\Validator;


use Illuminate\Http\Request;

class MasterNamesValidator implements ValidatorInterface
{

    public static function validate(Request $request)
    {
        return ValidatorHelper::validator($request->all(), [
            'phone' => 'required',
            'wechat_no'        => 'required|string',
        ]);
    }

    public static function toParams($extra)
    {
        return $extra;
    }
}
