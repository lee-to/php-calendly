<?php

namespace CalendlyApi;

use CalendlyApi\Exceptions\ModelNotFoundException;
use CalendlyApi\HttpAdapters\HttpClientInterface;
use CalendlyApi\Models\BaseModel;

/**
 * @method  \CalendlyApi\Models\User user()
 * @method  \CalendlyApi\Models\Hook hook()
 */

final class CalendlyApi
{
    /**
     *
     */
    const HOST = "https://calendly.com";

    /**
     *
     */
    const VERSION = "v1";

    /**
     * @var HttpClientInterface
     */
    protected $adapter;


    /**
     * @var
     */
    protected $token;

    /**
     * CalendlyApi constructor.
     * @param string $token
     * @param HttpClientInterface $adapter
     */
    public function __construct(string $token, HttpClientInterface $adapter)
    {
        $this->setToken($token);
        $this->setAdapter($adapter);
    }


    /**
     * @param string $token
     */
    protected function setToken(string $token) : void {
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getToken() : string {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getBaseUrl() : string
    {
        return static::HOST . "/api/" . static::VERSION;
    }

    /**
     * @param $instance
     * @param string ...$parameters
     * @return string
     */
    public function getEndpoint($instance, ...$parameters) : string
    {
        return trim($this->getBaseUrl() . "/" . $instance . "/" . (!empty($parameters) ? implode("/", $parameters) : ""), "/");
    }

    /**
     * @return HttpClientInterface
     */
    public function getAdapter() : HttpClientInterface
    {
        return $this->adapter;
    }

    /**
     * @param HttpClientInterface $adapter
     */
    protected function setAdapter($adapter) : void
    {
        $this->adapter = $adapter;
    }

    /**
     * @return Responses\RawResponse
     */
    public function echo() {
        return $this->getAdapter()->get($this->getEndpoint("echo"), $this->getToken());
    }

    /**
     * @param $name
     * @param $arguments
     * @return BaseModel
     * @throws ModelNotFoundException
     */
    public function __call($name, $arguments)
    {
        $className = '\\CalendlyApi\\Models\\' . ucfirst($name);

        if (!class_exists($className)) {
            throw new ModelNotFoundException($name);
        }

        $model = new $className($this);

        return $model;
    }
}