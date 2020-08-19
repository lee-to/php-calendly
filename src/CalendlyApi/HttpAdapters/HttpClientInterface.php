<?php

namespace CalendlyApi\HttpAdapters;


use CalendlyApi\Responses\RawResponse;

/**
 * Interface HttpClientInterface
 * @package CalendlyApi\HttpAdapters
 */
interface HttpClientInterface
{
    /**
     * @param $url
     * @param string $token
     * @param array $data
     * @return RawResponse
     */
    public function get($url, $token, $data = []) : RawResponse;

    /**
     * @param $url
     * @param string $token
     * @param array $data
     * @return RawResponse
     */
    public function post($url, $token, $data = []) : RawResponse;


    /**
     * @param $url
     * @param $token
     * @param array $data
     * @return RawResponse
     */
    public function delete($url, $token, $data = []) : RawResponse;

    /**
     * @param $method
     * @param $url
     * @param array $data
     * @param string $token
     * @param array $headers
     * @return RawResponse
     */
    public function request($method, $url, $token, $data = [], $headers = []) : RawResponse;
}