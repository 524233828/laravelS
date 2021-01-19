<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/6/14
 * Time: 15:19
 */

namespace Helper\Forecast;


class Filter
{
    //恋爱桃花
    public static function lath($result)
    {
        $response = [];

        $response['kaiYun'] = $result['tao_hua_kai_yun'];
        $response['taoHuaShuJu'] = $result['peach_flowers_data'];
        $response['taoHua'] = $result['peach_flowers'];
        $response['yinChangTaoHuaShuJu'] = $result['hide_peach_flower_data'];
        $response['xinXi'] = $result['self'];
        $response['aiQingMiJi'] = $result['ai_qing_mi_ji'];
        $response['dianPing'] = $result['dian_ping'];
        $response['taoHuaZhiShu'] = $result['flower_power'];
        $response['yinChangTaoHua'] = $result['hide_peach_flower'];
        $response['miJi'] = $result['mi_ji'];
        $response['taoHuaKaiYun'] = $result['tao_hua_kai_yun'];
        $response['yinYuanJiHui'] = $result['yin_yuan_ji_hui'];
        $response['taoHuaShuXing'] = $result['peach_attr'];
        return $response;
    }

    public static function yscf($result)
    {
        $response = [];

//        $response['banGongShi'] = $result['ban_gong_shi'];
        $response['caiYunBianHua'] = $result['cai_yun_bian_hua'];
        $response['deCai'] = $result['de_cai'];
        $response['duYun'] = $result['du_yun'];
//        $response['fanTaiSui'] = $result['fan_tai_sui'];
//        $response['fengShuiKaiYun'] = $result['feng_shui_kai_yun'];
        $response['poCai'] = $result['po_cai'];
//        $response['shiWuKaiYun'] = $result['shi_wu_kai_yun'];
        $response['yongHuXinXi'] = $result['self'];
        $response['yiShengCaiYun'] = $result['yi_sheng_cai_yun'];
        $response['zhengPianCaiYun'] = $result['zheng_pian_cai_yun'];
        return $response;
    }

    public static function bzjp($result)
    {
        return $result;
    }

    public static function lapd($result)
    {
        return $result;
    }

    public static function bzpp($result)
    {
        return $result;
    }

    public static function lhs($result)
    {
        return $result;
    }

    public static function mll($result)
    {
        return $result;
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
        return $result;
    }

    public static function family($request)
    {
        return $request;
    }

    public static function todo($request)
    {
        return $request;
    }

    public static function baoBaoQiMingApp($result)
    {
        $names = $result['names'];
        $page = request()->get("page", 1);
        $size = request()->get("size", 10);

        $response_names = [];
        $names_fingerprint = [];
        foreach ($names as $type => $name) {
            $response_names = array_merge($response_names, $name);
        }

        //取名字指纹码
        foreach ($response_names as $key => $name) {
            $fingerprint = md5(json_encode($name, 320));
            $names_fingerprint[$fingerprint] = $key;
        }
        //对指纹码排序
        ksort($names_fingerprint);

        $names_fingerprint = array_slice($names_fingerprint, ($page - 1) * $size, $size);

        $result['names'] = [];
        foreach ($names_fingerprint as $key) {
            $result['names'][] = $response_names[$key];
        }

        return $result;
    }

    public static function teacherQiMing($result)
    {
        return $result;
    }
}