<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019/3/5
 * Time: 15:48
 */

namespace Helper\Forecast\Validator;


use Illuminate\Http\Request;

class QinMiGuanXiValidator implements ValidatorInterface
{
    public static function validate(Request $request)
    {
        $data = ValidatorHelper::validator($request->all(), [
            'avoid' => 'required|min:18|max:126',
            'anxiety' => 'required|min:18|max:126',
        ]);

        $data['type'] = 1;

        return $data;
    }

    public static function toParams($extra)
    {
        return $extra;
    }
}