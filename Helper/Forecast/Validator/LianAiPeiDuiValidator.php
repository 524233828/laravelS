<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/7/30
 * Time: 17:01
 */

namespace Helper\Forecast\Validator;


use Illuminate\Http\Request;

class LianAiPeiDuiValidator implements ValidatorInterface
{
    public static function validate(Request $request)
    {
        return ValidatorHelper::validator($request->all(), [
            'name' => 'required',
            'birthday' => 'required|date',
            'gender' => 'required|in:male,female',
            'other_name' => 'required',
            'other_birthday' => 'required|date',
            'other_gender' => 'required|in:male,female',
        ]);

    }

    public static function toParams($extra)
    {
        return $extra;
    }
}