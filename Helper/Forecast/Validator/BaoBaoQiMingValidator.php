<?php

namespace Helper\Forecast\Validator;

use Illuminate\Http\Request;

class BaoBaoQiMingValidator implements ValidatorInterface
{
    public static function validate(Request $request)
    {
        return ValidatorHelper::validator($request->all(), [
            'family_name' => 'required',
            'gender'      => 'required|in:female,male',
            'birthday'    => 'required',
            'is_single'   => 'required|in:yes,no',
        ]);

    }

    public static function toParams($extra)
    {
        return $extra;
    }
}