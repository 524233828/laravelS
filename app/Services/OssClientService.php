<?php
/**
 * Created by PhpStorm.
 * User: chenyu
 * Date: 2019-11-22
 * Time: 11:06
 */

namespace App\Services;


use OSS\OssClient;

class OssClientService
{

    private $ossClientPool = [];

    /**
     * 获取节点
     * @param $end_point
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return OssClient
     * @throws \OSS\Core\OssException
     */
    public function getOssClient($end_point, $accessKeyId, $accessKeySecret)
    {
        if(isset($this->ossClientPool[$end_point]) && $this->ossClientPool[$end_point] instanceof OssClient)
        {
            return $this->ossClientPool[$end_point];
        }

        $this->ossClientPool[$end_point] = new OssClient($accessKeyId, $accessKeySecret, $end_point);
        return $this->ossClientPool[$end_point];
    }

}