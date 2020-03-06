<?php

namespace CloudyCity\TencentMarketingSDK\Kernel\Traits;

use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\Exception;

/**
 * Trait HasSubInvoker.
 *
 * @property array $providers
 */
trait HasSubInvoker
{
    use HasSdkBaseInfo;

    protected $instances = [];

    abstract public function getResponseType();

    abstract public function setResponseType($responseType);

    /**
     * @param $name
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            if (array_key_exists($name, $this->instances)) {
                return $this->instances[$name];
            }

            if (property_exists($this, 'providers') && array_key_exists($name, $this->providers)) {
                $advertiserId = $this->getAdvertiserId();
                $accessToken = $this->getAccessToken();
                $responseType = $this->getResponseType();

                return new $this->providers[$name]($advertiserId, $accessToken, $responseType);
            }

            if (method_exists($this, 'factory')) {
                return $this->factory($name);
            }

            throw new Exception("Undefined property $name", 500);
        }

        return $this->$name;
    }
}
