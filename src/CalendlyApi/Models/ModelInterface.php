<?php

namespace CalendlyApi\Models;


/**
 * Interface ModelInterface
 * @package CalendlyApi\Models
 */
interface ModelInterface
{
    /**
     * @return mixed
     */
    public function getModelName();

    /**
     * @param $resource
     * @return mixed
     */
    public function setResource($resource);
}