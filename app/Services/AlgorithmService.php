<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2018/5/8
 * Time: 11:52
 */

namespace App\Services;

use GuzzleHttp\Client;

/**
 * @method array algorithm(array $prams, string $uri)
 * Class AlgorithmService
 * @package Service
 */
class AlgorithmService
{

    private $http;

    private $uri;

    const DOMAIN = "http://127.0.0.1:8001";

    const NEW_DOMAIN = "http://120.79.254.39:9002";
    const NEW_DOMAIN_PROD = "http://120.79.254.39:9002";

    public function getNewDomain($env = "dev")
    {
        return env("ALGORITHM_URL", self::NEW_DOMAIN);
    }

    public function __construct()
    {
        $this->http = new Client();

        $this->uri = new Uri(self::DOMAIN);
    }

    /**
     * 恋爱桃花
     * @param $data
     * @return mixed
     */
    public function lianAiTaoHua($data)
    {
        $uri = clone $this->uri;

        $uri->withPath("/tao_hua");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 紫薇财运
     * @param $data
     * @return mixed
     */
    public function ziWeiCaiYun($data)
    {

        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/tab/zi_wei_cai_yun");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 八字精批
     * @param $data
     * @return mixed
     */
    public function baZiJingPi($data)
    {

        $uri = clone $this->uri;

        $uri->withPath("/ba_zi_jing_pi");
        $data['type'] = '2019';

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 八字排盘
     * @param $data
     * @return mixed
     */
    public function baZiPaiPan($data)
    {

        $uri = clone $this->uri;

        $uri->withPath("/ba_zi_pai_pan");
        $data['type'] = 'di_wang';

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 恋爱配对
     * @param $data
     * @return mixed
     */
    public function lianAiPeiDui($data)
    {

        $uri = clone $this->uri;

        $uri->withPath("/lian_ai_pei_dui");
//        $data['type'] = 'di_wang';

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 轮回书
     * @param $data
     * @return mixed
     */
    public function lunHuiShu($data)
    {

        $uri = clone $this->uri;

        $uri->withPath("/lun_hui_shu");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 麦玲玲2019运势
     * @param $data
     * @return mixed
     */
    public function maiLingLing($data)
    {
        $uri = clone $this->uri;

        $uri->withPath("/mll_yun_shi");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 塔罗牌
     * @param $data
     * @return mixed
     */
    public function taLuo($data)
    {
        $uri = clone $this->uri;

        $uri->withPath("/ta_luo");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }


    /**
     * 每日运势
     * @param $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function meiRiYunShi($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/yun_shi/day");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 八字合婚
     * @param $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function baZiHeHun($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/ba_zi/he_hun");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 职业性格
     * @param $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function zhiYeXingGe($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/ce_si/zhi_ye_xing_ge");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 亲密关系
     * @param $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function qinMiGuanXi($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/ce_si/qin_mi_guan_xi");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 事业
     * @param $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function shiYe($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/shi_ye");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    /**
     * 观音灵签
     * @param $data
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function guanYinLingQian($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/guan_yin/ssj");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    public function yiYu($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/ce_si/yi_yu");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    public function jiaoLv($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/ce_si/jiao_lv");

        $uri->withQuery($data);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }

    public function getNamesBaseList($data)
    {
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath("/api/names/base_list");

        $options = [
            "json" => $data,
        ];

        return $this->http->request("POST", (string)$uri, $options);
    }

    public function getTeacherQrCode($data)
    {
        return [
            "teacher_qrcode" => "https://resource-cs-cykjai-com.oss-cn-shanghai.aliyuncs.com/uploads/images/WechatIMG55.jpeg",
            "custom_service_qrcode" => "https://resource-cs-cykjai-com.oss-cn-shanghai.aliyuncs.com/uploads/images/custom_service_qrcode.jpeg"
        ];
    }

    /**
     * 如果数据库配置算法uri 而未定制算法入口调用此处请求
     * @param $name
     * @param $arguments
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __call($name, $arguments)
    {
        if ((!isset($arguments[1]) && !empty($arguments[1])) || !is_array($arguments[0])) {
            throw new \RuntimeException('The algorithm is undefined');
        }
        $uri = new Uri($this->getNewDomain(config()->get("environment", "dev")));

        $uri->withPath($arguments[1]);

        $uri->withQuery($arguments[0]);

        $response = $this->http->request("GET", (string)$uri);

        return json_decode($response->getBody(), true);
    }
}