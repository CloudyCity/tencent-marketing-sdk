<?php
/**
 * API 构造工厂
 *
 * 可以用于还没实现的接口进行实例化
 *
 * User: lizhicheng@shiyuegame.com
 * Date: 2019/8/14
 * Time: 11:15
 */

namespace MrSuperLi\Tencent\Ads;


class ApiFactory
{

    /**
     * 工厂函数
     *
     * @param $accessToken
     * @param $resource
     * @return MarketingApi
     * @throws Exception\InvalidResourceException
     */
    public static function factory($accessToken, $resource) {
        return (new MarketingApi($accessToken))->setResourceName($resource);
    }
}