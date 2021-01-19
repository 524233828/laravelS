<?php

namespace Helper\Forecast\Validator;

use Illuminate\Http\Request;

class BaoBaoJieMingValidator implements ValidatorInterface
{
    public static function validate(Request $request)
    {
        return ValidatorHelper::validator($request->all(), [
            'family_name' => 'required',
            'name'        => 'required|string',
            'birthday'    => 'required',
            'gender'      => 'required|in:female,male',
        ]);
    }

    public static function toParams($extra)
    {
        return $extra;
    }
}