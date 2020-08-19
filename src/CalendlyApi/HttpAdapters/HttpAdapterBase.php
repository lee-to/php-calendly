<?php

namespace CalendlyApi\HttpAdapters;

use CalendlyApi\Responses\RawResponse;

/**
 * Class HttpAdapterBase
 * @package CalendlyApi\HttpAdapters
 */
abstract class HttpAdapterBase
{
    /**
     * @var
     */
    protected $client;

    /**
     * HttpAdapterBase constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $url
     * @param array $data
     * @param string $token
     * @return RawResponse
     */
    public function get($url, $token, $data = []) : RawResponse
    {
        return $this->request("GET", $url, $token, $data);
    }

    /**
     * @param $url
     * @param array $data
     * @param string $token
     * @return RawResponse
     */
    public function post($url, $token, $data = []) : RawResponse
    {
        return $this->request("POST", $url, $token, $data);
    }

    /**
     * @param $url
     * @param $token
     * @param array $data
     * @return RawResponse
     */
    public function delete($url, $token, $data = []) : RawResponse
    {
        return $this->request("DELETE", $url, $token, $data);
    }

    /**
     * @param $method
     * @param $url
     * @param array $data
     * @param string $token
     * @param array $headers
     * @return RawResponse
     */
    abstract function request($method, $url, $token, $data = [], $headers = []) : RawResponse;
}