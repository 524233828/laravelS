<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/6/14
 * Time: 9:56
 */

namespace Helper\Forecast;

use App\Models\FcForecast;
use App\Services\AlgorithmService;

class ForecastHelper
{
    private $forecast_id;

    private $forecast;

    public function __construct($forecast_id)
    {
        $this->forecast_id = $forecast_id;
        $this->forecast = FcForecast::query()->find($forecast_id);
    }

    public function getExtra()
    {
        $validator = $this->forecast['template'];

        $data = call_user_func("\\Helper\\Forecast\\Validator\\".$validator.'::validate', request());

        return $data;
    }

    /**
     * @param $extra
     * @return mixed
     * @throws \Exception
     */
    public function getResult($extra)
    {
        $log = myLog("algorithm");

        $func = $this->forecast['result_com'];
        $log->addDebug("func:".$func);
        $log->addDebug("params",$extra);
        $sdk = new AlgorithmService();

        if (isset($this->forecast['algorithm_uri'])) {
            $result = call_user_func([$sdk,$func], $extra, $this->forecast['algorithm_uri']);
        }else{
            $result = call_user_func([$sdk,$func], $extra);
        }

        if(empty($result)){
            throw new \Exception("算法无返回", 0);
        }
        $log->addDebug("result", is_array($result) ? $result : [$result]);
        return $result;
    }


    public function filter($result)
    {
        $func = $this->forecast['filter'];

        $response = call_user_func("\\Helper\\Forecast\\Filter::".$func, $result);

        return $response;
    }

    public function nonPaymentFilter($result)
    {
        $func = $this->forecast['filter'];

        $response = call_user_func("\\Helper\\Forecast\\NonPaymentFilter::".$func, $result);

        return $response;
    }

    public function extraToAlgorithmParams($extra)
    {
        $validator = $this->forecast['template'];

        $data = call_user_func("\\Helper\\Forecast\\Validator\\".$validator.'::toParams', $extra);

        return $data;
    }

    public function getQuestion()
    {
        $func = $this->forecast['result_com'];

        $sdk = new AlgorithmService();

        $result = call_user_func([$sdk,$func], ["type" => 0]);

        return $result;
    }

}