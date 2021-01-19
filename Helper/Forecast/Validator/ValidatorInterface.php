<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019-07-05
 * Time: 17:12
 */

namespace Helper\Forecast\Validator;

use Illuminate\Http\Request;

interface ValidatorInterface
{

    public static function validate(Request $request) ;

    public static function toParams($extra);

}