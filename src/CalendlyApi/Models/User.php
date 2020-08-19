<?php

namespace CalendlyApi\Models;


/**
 * Class User
 * @package CalendlyApi\Models
 */
class User extends BaseModel implements ModelInterface
{

    /**
     * @var string
     */
    protected $instance = "users";

    /**
     * @var array
     */
    protected $excludeActions = ["update", "create", "delete", "get", "all"];

    /**
     * @return mixed
     */
    public function me() {
        return $this->requestResponse("get", "me");
    }

    /**
     * @return mixed
     */
    public function event_types() {
        return $this->requestResponse("get", "me/event_types", [], "EventTypes");
    }
}