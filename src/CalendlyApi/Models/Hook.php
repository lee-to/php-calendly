<?php

namespace CalendlyApi\Models;


class Hook extends BaseModel implements ModelInterface
{

    /**
     * @var string
     */
    protected $instance = "hooks";

    /**
     * @var array
     */
    protected $excludeActions = ["update"];
}