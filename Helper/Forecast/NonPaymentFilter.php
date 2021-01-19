<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/12/23
 * Time: 11:27
 */

namespace Helper\Forecast;


class NonPaymentFilter
{
    //恋爱桃花
    public static function lath($result)
    {
        $response = [];

        $response['taoHuaShuJu']['title'] = $result['peach_flowers_data']['title'];
        $response['taoHuaShuJu']['abstract'] = $result['peach_flowers_data']['abstract'];
        $response['taoHuaShuJu']['dec'][0] = $result['peach_flowers_data']['dec'][0];

        unset($response['taoHuaShuJu']['dec'][0]['img']);

        return $response;
    }

    public static function yscf($result)
    {
        $response = [];

        $response['yiShengCaiYun']['title'] = $result['yi_sheng_cai_yun']['title'];
        $response['yiShengCaiYun']['dec'][0] = $result['yi_sheng_cai_yun']['dec'][0];
        $response['zhengPianCaiYun'] = $result['zheng_pian_cai_yun'];

        return $response;
    }

    public static function bzjp($result)
    {
        return $result;
    }

    public static function lapd($result)
    {
        $response = [];

        $response['ai_qing_te_dian'][0] = $result['ai_qing_te_dian'][0];
        $response['pei_dui'][0] = $result['pei_dui'][0];
        return $response;
    }

    public static function bzpp($result)
    {
        return $result;
    }

    public static function lhs($result)
    {
        $response = [];

        $response['one']['title'] = $result['one']['title'];
        $response['one']['dao'] = $result['one']['dao'];
        $response['one']['age'] = $result['one']['age'];
        $response['one']['relation'] = $result['one']['relation'];

        $response['two']['title'] = $result['two']['title'];
        $response['two']['dao'] = $result['two']['dao'];
        $response['two']['age'] = $result['two']['age'];
        $response['two']['relation'] = $result['two']['relation'];

        $response['three']['title'] = $result['three']['title'];
        $response['three']['dao'] = $result['three']['dao'];
        $response['three']['age'] = $result['three']['age'];
        $response['three']['relation'] = $result['three']['relation'];

        $response['four']['title'] = $result['four']['title'];
        $response['four']['dao'] = $result['four']['dao'];
        $response['four']['age'] = $result['four']['age'];
        $response['four']['relation'] = $result['four']['relation'];

        return $response;
    }

    public static function mll($result)
    {
        //        $response['zong_ti'] = $result['zong_ti'];
        $response['liu_nian']['data'][0] = $result['liu_nian']['data'][0];
        return $response;
    }

    public static function taluo($result)
    {
        return $result;
    }

    public static function hehun($result)
    {
        return $result;
    }

    public static function zhiYeXingGe($result)
    {
        return $result;
    }

    public static function qinMiGuanXi($result)
    {
        return $result;
    }

    public static function shiYe($result)
    {
        return $result;
    }

    public static function guanYinLingQian($result)
    {
        return $result;
    }

    public static function baoBaoQiMing($result)
    {
        $response['self'] = $result['self'];
        $response['names']['yi_ban'] = $result['names']['yi_ban'];

        return $response;
    }

    public static function family($request)
    {
        return $request;
    }

    public static function todo($request)
    {
        return $request;
    }

    public static function jieMing($result)
    {
        $response['bai_jia_xing'] = $result['bai_jia_xing'];
        $response['jie_ming'] = $result['jie_ming'];
        return $response;
    }

    public static function baoBaoQiMingApp($result)
    {
        $response['self'] = $result['self'];
        $response['names']['yi_ban'] = $result['names']['yi_ban'];

        if (!empty($response['names']['yi_ban'])) {

            //取名字指纹码
            $names_fingerprint = [];
            foreach ($response['names']['yi_ban'] as $key => $name) {
                $fingerprint = md5(json_encode($name, 320));
                $names_fingerprint[$fingerprint] = $key;
            }
            //对指纹码排序
            ksort($names_fingerprint);

            $names_fingerprint = array_slice($names_fingerprint, 0, 10);

            $names = $response['names']['yi_ban'];
            $response['names']['yi_ban'] = [];
            foreach ($names_fingerprint as $key) {
                $response['names']['yi_ban'][] = $names[$key];
            }

        }
        return $response;
    }

    public static function teacherQiMing($result)
    {
        $response['custom_service_qrcode'] = $result['custom_service_qrcode'];
        return $response;
    }
}