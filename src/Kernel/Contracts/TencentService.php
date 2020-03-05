<?php

namespace CloudyCity\TencentMarketingSDK\Kernel\Contracts;

/**
 * Interface TencentService.
 */
interface TencentService
{
    /**
     * Get all apps from cache.
     *
     * @return mixed
     */
    public static function getApps();

    /**
     * Get the specified app from the cache.
     *
     * @param $appId
     *
     * @return mixed
     */
    public static function getApp($appId);

    /**
     * Get all AdvertiserId from Cache.
     *
     * @return mixed
     */
    public function getAdvertiserIds();

    /**
     * Get tokens from API and save to cache.
     *
     * @param $authCode
     *
     * @return mixed
     */
    public function getTokens($authCode);

    /**
     * Get token from cache.
     *
     * @param $advertiserId
     * @param bool $checkAvailability Whether to check availability
     *
     * @return mixed
     */
    public function getTokensByCache($advertiserId, $checkAvailability = true);

    /**
     * Refresh token.
     *
     * @param array $tokens
     *
     * @return mixed
     */
    public function refreshTokens(array $tokens);

    /**
     * Save token to cache.
     *
     * @param array $tokens
     *
     * @return mixed
     */
    public function saveTokens(array $tokens);

    /**
     * Check token availability，refresh token on expiration.
     *
     * @param array $tokens
     *
     * @return mixed
     */
    public function checkToken(array $tokens);
}
