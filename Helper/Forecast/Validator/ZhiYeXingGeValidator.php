<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019/3/5
 * Time: 15:48
 */

namespace Helper\Forecast\Validator;


use FastD\Http\ServerRequest;
use Illuminate\Http\Request;

class ZhiYeXingGeValidator implements ValidatorInterface
{
    public static function validate(Request $request)
    {
        $data = ValidatorHelper::validator($request->all(), [
            'si' => 'required|min:0|max:100',
            'fe' => 'required|min:0|max:100',
            'ti' => 'required|min:0|max:100',
            'ne' => 'required|min:0|max:100',
            'fi' => 'required|min:0|max:100',
            'te' => 'required|min:0|max:100',
            'ni' => 'required|min:0|max:100',
            'se' => 'required|min:0|max:100',
        ]);

        $data['type'] = 1;

        return $data;
    }

    public static function toParams($extra)
    {
        return $extra;
    }
}