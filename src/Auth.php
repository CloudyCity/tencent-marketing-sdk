<?php

namespace CloudyCity\TencentMarketingSDK;

use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\AuthException;
use CloudyCity\TencentMarketingSDK\Kernel\Traits\HasHttpRequests;

class Auth
{
    use HasHttpRequests;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $baseUrl = 'https://api.e.qq.com/';

    /**
     * Auth constructor.
     *
     * @param $clientId
     * @param $clientSecret
     * @param $responseType
     */
    public function __construct($clientId, $clientSecret, $responseType = 'array')
    {
        $this->setClientId($clientId);
        $this->setClientSecret($clientSecret);
        $this->setResponseType($responseType);
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @param $authCode
     * @param $redirectUri
     *
     * @throws AuthException
     * @throws Kernel\Exceptions\Exception
     * @throws Kernel\Exceptions\InvalidArgumentException
     *
     * @return array|Kernel\Http\Response|\Doctrine\Common\Collections\ArrayCollection|object|\Psr\Http\Message\ResponseInterface
     */
    public function getTokens($authCode, $redirectUri)
    {
        $params = [
            'client_id'          => $this->getClientId(),
            'client_secret'      => $this->getClientSecret(),
            'grant_type'         => 'authorization_code',
            'authorization_code' => $authCode,
            'redirect_uri'       => $redirectUri,
        ];

        return $this->get('oauth/token', $params);
    }

    /**
     * @param $refreshToken
     *
     * @throws AuthException
     * @throws Kernel\Exceptions\Exception
     * @throws Kernel\Exceptions\InvalidArgumentException
     *
     * @return array|Kernel\Http\Response|\Doctrine\Common\Collections\ArrayCollection|object|\Psr\Http\Message\ResponseInterface
     */
    public function refreshTokens($refreshToken)
    {
        $params = [
            'client_id'     => $this->getClientId(),
            'client_secret' => $this->getClientSecret(),
            'grant_type'    => 'refresh_token',
            'refresh_token' => $refreshToken,
        ];

        return $this->get('oauth/token', $params);
    }

    /**
     * @param $url
     * @param array $params
     *
     * @throws AuthException
     * @throws Kernel\Exceptions\Exception
     * @throws Kernel\Exceptions\InvalidArgumentException
     *
     * @return array|Kernel\Http\Response|\Doctrine\Common\Collections\ArrayCollection|object|\Psr\Http\Message\ResponseInterface
     */
    private function get($url, array $params)
    {
        $response = $this->request($url, 'GET', [
            'query' => $params,
        ]);

        $result = $this->castResponseToType($response);
        $formatted = $this->castResponseToType($response, $this->getResponseType());

        if (!isset($result['code']) || $result['code'] != 0) {
            $message = isset($result['message']) ? $result['message'] : '';
            $code = isset($result['code']) ? $result['code'] : 0;

            throw new AuthException($message, $response, $formatted, $code);
        }

        return $formatted;
    }
}
