<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019/1/28
 * Time: 18:53
 */

namespace Helper\Forecast\Validator;


use FastD\Http\ServerRequest;
use Illuminate\Http\Request;

class TaLuoValidator implements ValidatorInterface
{

    public static function validate(Request $request)
    {
        $data = ValidatorHelper::validator($request->all(), [
            'type'         => 'required|in:free,sell',
            'is_single'    => 'required_if:type,sell|in:single,un_single',
        ]);

        for($i = 1; $i < 45; $i++)
        {
            $tarot[] = $i;
        }
        if($data['type'] == "free")
        {
            $data['tarot_free'] = rand(1,156);
        }else{
            shuffle($tarot);

            $data['tarot'] = array_pop($tarot);
            $data['tarot_past'] = array_pop($tarot);
            $data['tarot_future'] = array_pop($tarot);
        }

        return $data;
    }

    public static function toParams($extra)
    {
        return $extra;
    }
}