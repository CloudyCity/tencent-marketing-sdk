<?php

namespace CloudyCity\TencentMarketingSDK\Kernel;

use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\ApiException;
use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\Exception;
use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\InvalidActionException;
use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\InvalidResourceException;
use CloudyCity\TencentMarketingSDK\Kernel\Http\Parameters\Params;
use CloudyCity\TencentMarketingSDK\Kernel\Traits\HasHttpRequests;
use CloudyCity\TencentMarketingSDK\Kernel\Traits\HasSdkBaseInfo;
use CloudyCity\TencentMarketingSDK\Resources;

class BaseClient
{
    use HasHttpRequests, HasSdkBaseInfo {
        request as performRequest;
        HasHttpRequests::getResponseType insteadof HasSdkBaseInfo;
        HasHttpRequests::setResponseType insteadof HasSdkBaseInfo;
    }

    /**
     * The base url of official environmental.
     *
     * @var string
     */
    protected $baseUrl = 'https://api.e.qq.com';

    /**
     * The base url of sandbox environmental.
     *
     * @var string
     */
    protected $sandboxBaseUrl = 'https://sandbox-api.e.qq.com';

    /**
     * The version of API.
     *
     * @var string
     */
    protected $version = 'v1.1';

    /**
     * Whether it is a sandbox environment.
     *
     * @var bool
     */
    protected $sandbox = false;

    /**
     * Resource.
     *
     * @var string
     */
    protected $resource;

    /**
     * Fields.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Client constructor.
     *
     * @param $advertiserId
     * @param $accessToken
     * @param string $responseType
     */
    public function __construct($advertiserId, $accessToken, $responseType = 'array')
    {
        $this->setAdvertiserId($advertiserId);
        $this->setAccessToken($accessToken);
        $this->setResponseType($responseType);
    }

    /**
     * Set Fields.
     *
     * @param array $fields
     *
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Get fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set env.
     *
     * @param bool $sandbox
     *
     * @return $this
     */
    public function setSandbox($sandbox = true)
    {
        $this->sandbox = boolval($sandbox);

        return $this;
    }

    /**
     * Set version.
     *
     * @param $version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get Version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Whether it is a sandbox environment.
     *
     * @return bool
     */
    public function isSandbox()
    {
        return $this->sandbox;
    }

    /**
     * Get base url for request.
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->isSandbox() ? $this->sandboxBaseUrl : $this->baseUrl;
    }

    /**
     * Set resource name.
     *
     * @param $resource
     * @param bool $checkValid
     *
     * @throws InvalidResourceException
     *
     * @return $this
     */
    public function setResource($resource, $checkValid = true)
    {
        if ($checkValid && !Resources::checkResource($resource)) {
            throw new InvalidResourceException('Invalid resource:'.$resource);
        }

        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource name.
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Get url for request.
     *
     * @param $action
     *
     * @throws InvalidResourceException
     *
     * @return string
     */
    public function getRequestUrl($action)
    {
        if (!Resources::checkResource($resource = $this->getResource())) {
            throw new InvalidResourceException('Invalid resource:'.$resource);
        }

        return sprintf('%s/%s/%s/%s', $this->getBaseUrl(), $this->getVersion(), $resource, $action);
    }

    /**
     * Request.
     *
     * @param $action
     * @param array $params
     * @param array $headers
     * @param bool  $returnRaw
     *
     * @throws ApiException
     * @throws Exception
     * @throws Exceptions\InvalidArgumentException
     * @throws InvalidActionException
     * @throws InvalidResourceException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function request($action, $params = [], $headers = [], $returnRaw = false)
    {
        if (!$this->checkAction($action)) {
            throw new InvalidActionException("resource {$this->getResource()} does not support action:".
                "{$action}, please check the official documentation");
        }

        $method = $action === 'get' ? 'get' : 'post';

        $url = $this->getRequestUrl($action);

        $options = [
            'headers' => $headers,
            'query'   => $this->getBaseQuery(),
        ];

        $params = Params::make($params);

        if ($params->isMultipart()) {
            $options['multipart'] = $params->toArray();
        } elseif ($method === 'get') {
            $options['query'] += $params->toArray();
        } else {
            $options['form_params'] = $params->toArray();
        }

        $response = $this->performRequest($url, $method, $options);

        $responseType = $this->getResponseType();

        $result = $this->castResponseToType($response);
        $formatted = $this->castResponseToType($response, $responseType);

        if (!isset($result['code']) || $result['code'] != 0) {
            $message = isset($result['message']) ? $result['message'] : '';
            $code = isset($result['code']) ? $result['code'] : 0;

            throw new ApiException($message, $response, $formatted, $code);
        }

        return $returnRaw ? $response : $this->castResponseToType($response, $responseType);
    }

    /**
     * Check Action for resource.
     *
     * @param $action
     *
     * @return bool
     */
    public function checkAction($action)
    {
        return in_array($action, $this->getValidActions());
    }

    /**
     * Get all valid actions for resource.
     *
     * @return array
     */
    public function getValidActions()
    {
        return ['get', 'add', 'update', 'delete'];
    }

    /**
     * Get resource.
     *
     * @param mixed $params
     *
     * @throws ApiException
     * @throws Exception
     * @throws Exceptions\InvalidArgumentException
     * @throws InvalidActionException
     * @throws InvalidResourceException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($params = [])
    {
        return $this->request('get', $params);
    }

    /**
     * Add resource.
     *
     * @param $params
     *
     * @throws ApiException
     * @throws Exception
     * @throws Exceptions\InvalidArgumentException
     * @throws InvalidActionException
     * @throws InvalidResourceException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function add($params)
    {
        return $this->request('add', $params);
    }

    /**
     * Update resource.
     *
     * @param $params
     *
     * @throws ApiException
     * @throws Exception
     * @throws Exceptions\InvalidArgumentException
     * @throws InvalidActionException
     * @throws InvalidResourceException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update($params)
    {
        return $this->request('update', $params);
    }

    /**
     * Delete resource.
     *
     * @param $params
     *
     * @throws ApiException
     * @throws Exception
     * @throws Exceptions\InvalidArgumentException
     * @throws InvalidActionException
     * @throws InvalidResourceException
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete($params)
    {
        return $this->request('delete', $params);
    }

    /**
     * Get all records by Generator. Each iteration of the loop is a response of singe page.
     *
     * @param Params $params
     * @param int    $pageSize
     * @param bool   $throwException
     *
     * @throws \Exception
     *
     * @return \Generator
     */
    public function getAllPages(Params $params = null, $pageSize = 100, $throwException = true)
    {
        $__params = clone Params::make($params);
        $__params->set('page_size', $pageSize);

        $page = $params->get('page') ?: 1;
        $__params->set('page', $page);

        $totalPage = 1;

        do {
            try {
                $result = $this->get($__params);
                $data = $this->detectAndCastResponseToType($result, 'collection')->get('data');
                $totalPage = $data['page_info']['total_page'];

                yield $result;
            } catch (\Exception $e) {
                if (!$throwException) {
                    yield $e;
                } else {
                    throw $e;
                }
            }

            $__params->set('page', ++$page);
        } while ($page <= $totalPage);
    }

    /**
     * Get required auth info for request.
     *
     * @return array
     */
    protected function getBaseQuery()
    {
        return [
            'access_token' => $this->getAccessToken(),
            'timestamp'    => time(),
            'nonce'        => Support\generate_nonce(),
            'account_id'   => $this->getAdvertiserId(),
        ];
    }
}
