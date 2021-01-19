<?php


/**
 * Class LianAiHuaShuValidator
 * @package Helper\Forecast\Validator
 */

namespace Helper\Forecast\Validator;

use Illuminate\Http\Request;

class LianAiHuaShuValidator implements ValidatorInterface
{

    public static function validate(Request $request)
    {
        return ValidatorHelper::validator($request->all(), [
            'type' => 'required',
        ]);
    }

    public static function toParams($extra)
    {
        return $extra;
    }
}