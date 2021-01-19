<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2020-03-20
 * Time: 16:15
 */

namespace Helper\Forecast\Validator;


class ValidatorHelper
{
    /**
     * 参数检查
     * @param $data
     * @param $rule
     * @return bool
     */
    public static function validator($data, $rule)
    {
        $validator = validator($data, $rule);

        if ($validator->fails()) {
            $err = $validator->errors()->toArray();

            $err_msg = "";
            foreach ($err as $field => $errors) {
                $err_msg .= "{$field}: " . implode(", ", $errors) . " ";
            }

            return false;
        }

        return $data;
    }
}
