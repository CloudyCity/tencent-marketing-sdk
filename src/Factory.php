<?php

namespace CloudyCity\TencentMarketingSDK;

use CloudyCity\TencentMarketingSDK\Kernel\BaseClient;

class Factory
{
    /**
     * @param $resource
     * @param $advertiserId
     * @param $accessToken
     * @param string $responseType
     * @param bool   $check
     *
     * @throws \CloudyCity\TencentMarketingSDK\Kernel\Exceptions\InvalidResourceException
     *
     * @return BaseClient
     */
    public static function getClient($resource, $advertiserId, $accessToken, $responseType = 'array', $check = false)
    {
        return (new BaseClient($advertiserId, $accessToken, $responseType))->setResource($resource, $check);
    }
}
