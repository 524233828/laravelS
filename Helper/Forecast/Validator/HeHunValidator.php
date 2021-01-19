<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019/3/5
 * Time: 10:38
 */

namespace Helper\Forecast\Validator;


use Illuminate\Http\Request;

class HeHunValidator implements ValidatorInterface
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
        $data = [];
        if($extra['gender'] == "male"){
            $data['male_name'] = $extra["name"];
            $data['male_birthday'] = $extra['birthday'];
            $data['female_name'] = $extra['other_name'];
            $data['female_birthday'] = $extra['other_birthday'];
        }else{
            $data['male_name'] = $extra["other_name"];
            $data['male_birthday'] = $extra['other_birthday'];
            $data['female_name'] = $extra['name'];
            $data['female_birthday'] = $extra['birthday'];
        }

        return $data;
    }
}