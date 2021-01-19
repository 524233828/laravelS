<?php

namespace Helper\Forecast\Validator;

use Illuminate\Http\Request;

class YiYuValidator implements ValidatorInterface
{
    public static function validate(Request $request)
    {
        $data = ValidatorHelper::validator($request->all(), [
            'score' => 'required|min:0|max:100',
        ]);

        $data['type'] = 1;

        return $data;
    }

    public static function toParams($extra)
    {
        return $extra;
    }
}