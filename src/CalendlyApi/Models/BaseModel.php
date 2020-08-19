<?php

namespace CalendlyApi\Models;

use CalendlyApi\Exceptions\EntityNotFoundException;
use CalendlyApi\Exceptions\CalendlyApiClientException;
use CalendlyApi\Models\Traits\DefaultModel;
use CalendlyApi\CalendlyApi;
use CalendlyApi\Resources\ResourceFactory;
use CalendlyApi\Responses\Interfaces\ResponseInterface;

/**
 * Class BaseModel
 * @package CalendlyApi\Models

 * @method  \CalendlyApi\Resources\BaseResource toArray()
 * @method  \CalendlyApi\Resources\BaseResource toJSON()
 * @method  \CalendlyApi\Resources\BaseResource count()
 */
abstract class BaseModel implements ModelInterface
{
    use DefaultModel;

    /**
     * @var
     */
    protected $app;

    /**
     * @var
     */
    protected $instance;

    /**
     * @var
     */
    protected $resource;

    /**
     * @var array
     */
    protected $excludeActions = [];

    /**
     * @var string
     */
    protected $parentVar = "data";

    /**
     * @var string
     */
    protected $customResource = "";

    /**
     * @var string
     */
    protected $parameters = "";


    /**
     * BaseModel constructor.
     * @param CalendlyApi $app
     */
    public function __construct(CalendlyApi $app)
    {
        $this->setApp($app);
    }

    /**
     * @return CalendlyApi
     */
    public function getApp(): CalendlyApi
    {
        return $this->app;
    }

    /**
     * @param CalendlyApi $app
     */
    protected function setApp(CalendlyApi $app): void
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    protected function getInstance()
    {
        return $this->instance;
    }

    /**
     * @param mixed $instance
     */
    protected function setInstance($instance): void
    {
        $this->instance = $instance;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @param mixed $resource
     */
    public function setResource($resource): void
    {
        $this->resource = $resource;
    }

    /**
     * @return mixed
     */
    protected function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param mixed $parameters
     */
    protected function setParameters($parameters): void
    {
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getParentVar(): string
    {
        return $this->parentVar;
    }

    /**
     * @param string $parentVar
     */
    public function setParentVar(string $parentVar): void
    {
        $this->parentVar = $parentVar;
    }

    /**
     * @return string
     */
    public function getCustomResource(): string
    {
        return $this->customResource;
    }

    /**
     * @param string $customResource
     */
    public function setCustomResource(string $customResource): void
    {
        $this->customResource = $customResource;
    }

    /**
     * @param array $values
     * @return $this
     * @throws /\CalendlyApi\Exceptions\ModelNotFoundException
     */
    public function update($values) {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->post($this->getApp()->getEndpoint($this->getInstance(), $this->getParameters()), $this->getApp()->getToken(), $values));
    }

    /**
     * @param array $values
     * @return $this
     * @throws /\CalendlyApi\Exceptions\ModelNotFoundException
     */
    public function create($values) {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->post($this->getApp()->getEndpoint($this->getInstance(), $this->getParameters()), $this->getApp()->getToken(), $values));
    }

    /**
     * @return $this|$this[]
     * @throws /\CalendlyApi\Exceptions\ModelNotFoundException
     */
    public function all() {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->get($this->getApp()->getEndpoint($this->getInstance()), $this->getApp()->getToken()));
    }

    /**
     * @param $parameter
     * @return $this
     * @throws /\CalendlyApi\Exceptions\ModelNotFoundException
     */
    public function get($parameter = "") {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->get($this->getApp()->getEndpoint($this->getInstance(), $parameter), $this->getApp()->getToken()));
    }

    /**
     * @param string $parameter
     * @return mixed
     * @throws CalendlyApiClientException
     */
    public function delete($parameter = "") {
        $this->beforeAction(__FUNCTION__);

        return $this->performResponse($this->getApp()->getAdapter()->delete($this->getApp()->getEndpoint($this->getInstance(), $parameter), $this->getApp()->getToken()));
    }

    /**
     * @param $actionName
     * @throws CalendlyApiClientException
     */

    private function beforeAction($actionName) {
        $this->performExcludes($actionName);
    }

    /**
     * @param $method
     * @throws CalendlyApiClientException
     */
    protected function performExcludes($method) {
        if(in_array($method, $this->excludeActions)) {

            throw new CalendlyApiClientException("Method '{$method}' not found in {$this->getInstance()}");
        }
    }

    /**
     * @param ResponseInterface $response
     * @param string $customResource
     * @param string $parentVar
     * @return mixed
     * @throws /\CalendlyApi\Exceptions\ModelNotFoundException
     */
    protected function performResponse(ResponseInterface $response, $customResource = "", $parentVar = "") {
        $customResource = $customResource == "" ? $this->getCustomResource() : $customResource;
        $parentVar = $parentVar == "" ? $this->getParentVar() : $parentVar;

        return ResourceFactory::create($this, $response->getArray(), $customResource, $parentVar);
    }

    /**
     * @param $method
     * @param string $parameter
     * @param array $data
     * @param string $customResource
     * @param string $parentVar
     * @return mixed
     */
    protected function requestResponse($method, $parameter = "", $data = [], $customResource = "", $parentVar = "") {
        return $this->performResponse($this->getApp()->getAdapter()->$method($this->getApp()->getEndpoint($this->getInstance(), $parameter), $this->getApp()->getToken(), $data), $customResource, $parentVar);
    }

    /**
     * @param $instance
     * @param string $parameter
     * @return mixed
     */
    protected function belongsTo($instance, $parameter = "") {
        return $this->getApp()->$instance()->get($parameter);
    }

    /**
     * @param $relation
     * @param $parameter
     * @param string $parentVar
     * @return mixed
     */
    protected function belongsToMany($relation, $parameter, $parentVar = "") {
        return $this->requestResponse("get", $parameter, [], $relation, $parentVar);
    }

    /**
     * @param $name
     * @return mixed
     * @throws EntityNotFoundException
     */
    public function __get($name)
    {
        if(!isset($this->getResource()->{$name})) {
            throw new EntityNotFoundException("Field not found");
        }

        return $this->getResource()->{$name};
    }
}