<?php
/**
 * 腾讯广告 API 通用封装
 *
 * 不能放具体请求在这里，这里只是封装所有请求通用的
 *
 * 正式环境为 https://api.e.qq.com/<API_VERSION>/<RESOURCE_NAME>/<RESOURCE_ACTION>
 * 沙箱环境为 https://sandbox-api.e.qq.com/<API_VERSION>/<RESOURCE_NAME>/<RESOURCE_ACTION>
 *
 * 协议：正式环境和沙箱环境均使用 HTTPS；
 * API_VERSION：版本号，当前最新版本号为 v1.1；
 * RESOURCE_NAME：表示要操作的资源，如campaigns、adcreatives；
 * RESOURCE_ACTION：表示对资源的动作，如 get,add,update
 * 例子： https://api.e.qq.com/v1.0/campaigns/add
 *
 * HTTP Method: 调用方应根据具体接口的要求设置 HTTP Method为 GET或POST。
 * HTTP Header: Content-Type: application/json
 * 编码方式: UTF-8
 *
 * 请求通用参数: access_token, timestamp, nonce 都是以Query Parameter方式在请求路径中传递。
 * 在V1.1版本的get接口中，请求参数增加fields字段，用于指定返回的字段列表。
 *
 * User: lizhicheng@shiyuegame.com
 * Date: 2019/8/13
 * Time: 14:48
 */

namespace MrSuperLi\Tencent\Ads;

use MrSuperLi\Tencent\Ads\Exception\InvalidActionException;
use MrSuperLi\Tencent\Ads\Exception\InvalidResourceException;
use MrSuperLi\Tencent\Ads\Parameters\Builder;
use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;


class MarketingApi
{

    /**
     * 正式环境请求地址
     *
     * @var string
     */
    protected $base_url = 'https://api.e.qq.com';

    /**
     * 沙箱环境请求地址
     *
     * @var string
     */
    protected $sandbox_base_url = 'https://sandbox-api.e.qq.com';

    /**
     * 请求腾讯Marketing API版本
     *
     * @var string
     */
    protected $api_version = 'v1.1';

    /**
     * 是否沙箱环境
     *
     * @var bool
     */
    protected $sandbox = false;

    /**
     * 请求的 token
     *
     * @var string
     */
    protected $access_token;

    /**
     * 资源名
     *
     * @var string
     */
    protected $resource_name;

    protected $fields = [];

    public function __construct($access_token)
    {
        $this->setAccessToken($access_token);
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields) {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @return array
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * 设置沙箱环境
     *
     * @param bool $sandbox
     * @return $this
     */
    public function setSandbox($sandbox = true) {
        $this->sandbox = boolval($sandbox);
        return $this;
    }

    /**
     * 设置 Marketing API 版本
     *
     * @param $version
     * @return $this
     */
    public function setVersion($version) {
        $this->api_version = $version;
        return $this;
    }

    public function getVersion() {
        return $this->api_version;
    }

    /**
     * 设置是否沙箱环境
     *
     * @return bool
     */
    public function isSandbox() {
        return $this->sandbox;
    }

    /**
     * 获取请求地址
     *
     * @return string
     */
    public function getBaseUrl() {
        return $this->isSandbox() ? $this->sandbox_base_url : $this->base_url;
    }

    /**
     * 获取请求的 token
     *
     * @param $accessToken
     * @return $this
     */
    public function setAccessToken($accessToken) {
        $this->access_token = strval($accessToken);
        return $this;
    }

    /**
     * 获取请求的 token
     *
     * @return string
     */
    public function getAccessToken() {
        return $this->access_token;
    }

    /**
     * 设置资源名
     *
     * @param $resourceName
     * @return $this
     * @throws InvalidResourceException
     */
    public function setResourceName($resourceName) {

        if (! Resources::checkResource($resourceName)) {
            throw new InvalidResourceException('Marketing Api 资源名错误:' . $resourceName);
        }

        $this->resource_name = $resourceName;
        return $this;
    }

    /**
     * 获取资源名
     *
     * @return string
     */
    public function getResourceName() {
        return $this->resource_name;
    }

    /**
     * 生成请求全局唯一的字符串
     * 前面13个字符是毫秒，后7个是随机字符
     *
     * @return string
     */
    public function createNonce()
    {
        $nonce = strval(floor(microtime(true) * 1000));
        $length = 7;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        for ($i = 0; $i < $length; $i++) {
            $nonce .= $chars{mt_rand(0, strlen($chars) - 1)};
        }
        return $nonce;
    }

    /**
     * 统一请求入口
     *
     * @param $method
     * @param $url
     * @param $params
     * @param array $headers
     * @return ArrayCollection
     * @throws \Exception
     */
    protected function _request($method, $url, $params, $headers = []) {
        $client = new Client([ 'timeout' => 1000 ]);

        $method = strtolower($method);

        $options = [ 'headers' => $headers, 'query' => $this->getBaseQueryParams() ];

        if ($method === 'get') {
            $options['query'] += $params;
        } else {
            $options['form_params'] = $params;
        }

        $response = $client->request($method, $url, $options);
        // 获取登陆后显示的页面
        $result = $response->getBody()->getContents();
        //$code = $response->getStatusCode(); // 200
        //$reason = $response->getReasonPhrase(); // OK

        $array = new ArrayCollection(json_decode($result,true) ?: []);

        if (0 != $array['code']) {
            throw new \Exception($array['message'], $array['code']);
        }

        return $array;
    }

    /**
     * 生成统一请求参数
     *
     * @return array
     */
    public function getBaseQueryParams() {
        return [
            'access_token' => $this->getAccessToken(),
            'timestamp' => time(),
            'nonce' => $this->createNonce(),
        ];
    }

    /**
     * 获取请求地址
     *
     * @param $action
     * @return string
     * @throws InvalidResourceException
     */
    public function getRequestUrl($action) {

        if ( !Resources::checkResource($resourceName = $this->getResourceName()) ) {
            throw new InvalidResourceException('Marketing Api 资源名错误:' . $resourceName);
        }

        return sprintf('%s/%s/%s/%s', $this->getBaseUrl(), $this->getVersion(), $resourceName, $action);
    }

    /**
     * 对外访问的请求接口
     *
     * @param $action
     * @param $params
     * @param array $headers
     * @return ArrayCollection
     * @throws InvalidActionException
     * @throws InvalidResourceException
     */
    public function request($action, $params, $headers = []) {

        if (! $this->checkAction($action)) {
            throw new InvalidActionException("资源 {$this->getResourceName()} 不支持操作: {$action}, 请查看官方文档");
        }

        $url = $this->getRequestUrl($action);

        $method = $action === 'get' ? 'get' : 'post';

        if (is_object($params) && method_exists($params, 'toArray')) {
            $params = $params->toArray();
        }

        return $this->_request($method, $url, $params, $headers);
    }

    /**
     * 验证操作
     *
     * @param $action
     * @return bool
     */
    public function checkAction($action) {
        return in_array($action, $this->getValidActions());
    }

    /**
     * 获取所有合法的操作
     *
     * @return array
     */
    public function getValidActions() {
        return [ 'get', 'add', 'update', 'delete' ];
    }

    /**
     * 资源查询
     *
     * @param $params
     * @return ArrayCollection
     * @throws InvalidActionException
     * @throws InvalidResourceException
     */
    public function get(Builder $params) {

        // 设置获取字段
        if (! $params->get('fields') && $this->fields) {
            $params->set('fields', $this->fields);
        }

        return $this->request('get', $params);
    }

    /**
     * 使用生成器翻页
     *
     * @param Builder $builder
     * @param int $pageSize
     * @return \Generator
     */
    public function getAllRecordIterator(Builder $builder, $pageSize = 100) {
        $builder->set('page_size', $pageSize);

        $page = $builder->get('page') ?: 1;
        $builder->set('page', $page);

        $totalPage = 1;

        do {
            try {
                $result = $this->get($builder)->get('data');

                $totalPage = $result['page_info']['total_page'];

                yield $result['list'];
            } catch (\Exception $e) {
                // 返回异常
                yield $e;
            }

            $builder->set('page', ++$page);
        } while ($page <= $totalPage);
    }

    /**
     * 添加资源
     *
     * @param $params
     * @return ArrayCollection
     * @throws InvalidActionException
     * @throws InvalidResourceException
     */
    public function add($params) {
        return $this->request('add', $params);
    }

    /**
     * 资源更新
     *
     * @param $params
     * @return ArrayCollection
     * @throws InvalidActionException
     * @throws InvalidResourceException
     */
    public function update($params) {
        return $this->request('update', $params);
    }

    /**
     * 删除资源
     *
     * @param $params
     * @return ArrayCollection
     * @throws InvalidActionException
     * @throws InvalidResourceException
     */
    public function delete($params) {
        return $this->request('delete', $params);
    }
}
