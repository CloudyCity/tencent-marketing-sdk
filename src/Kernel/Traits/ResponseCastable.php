<?php

namespace CloudyCity\TencentMarketingSDK\Kernel\Traits;

use CloudyCity\TencentMarketingSDK\Kernel\Contracts\Arrayable;
use CloudyCity\TencentMarketingSDK\Kernel\Exceptions\InvalidArgumentException;
use CloudyCity\TencentMarketingSDK\Kernel\Http\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait ResponseCastable from easywechat.
 */
trait ResponseCastable
{
    /**
     * @var string
     */
    protected $responseType;

    /**
     * @return string
     */
    protected function getResponseType()
    {
        return $this->responseType;
    }

    /**
     * @param string $responseType
     */
    protected function setResponseType($responseType)
    {
        $this->responseType = $responseType;
    }

    /**
     * @param ResponseInterface $response
     * @param string            $type
     *
     * @throws InvalidArgumentException
     *
     * @return array|Response|ArrayCollection|object|ResponseInterface
     */
    protected function castResponseToType(ResponseInterface $response, $type = 'array')
    {
        $response = Response::buildFromPsrResponse($response);
        $response->getBody()->rewind();

        switch ($type) {
            case 'collection':
                return $response->toCollection();
            case 'array':
                return $response->toArray();
            case 'object':
                return $response->toObject();
            case 'raw':
                return $response;
            default:
                if (!is_subclass_of($type, Arrayable::class)) {
                    throw new InvalidArgumentException(sprintf(
                        '"$responseType" classname must be an instanceof %s',
                        Arrayable::class
                    ));
                }

                return new $type($response);
        }
    }

    /**
     * @param $response
     * @param string $type
     *
     * @throws InvalidArgumentException
     *
     * @return array|Response|ArrayCollection|object|ResponseInterface
     */
    protected function detectAndCastResponseToType($response, $type = 'array')
    {
        switch (true) {
            case $response instanceof ResponseInterface:
                $response = Response::buildFromPsrResponse($response);

                break;
            case $response instanceof Arrayable:
                $response = new Response(200, [], json_encode($response->toArray()));

                break;
            case ($response instanceof ArrayCollection) || is_array($response) || is_object($response):
                $response = new Response(200, [], json_encode($response));

                break;
            case is_scalar($response):
                $response = new Response(200, [], (string) $response);

                break;
            default:
                throw new InvalidArgumentException(sprintf('Unsupported response type "%s"', gettype($response)));
        }

        return $this->castResponseToType($response, $type);
    }
}
