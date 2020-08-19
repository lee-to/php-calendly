<?php

namespace CalendlyApi\Resources;


/**
 * Class Hook
 * @package CalendlyApi\Resources
 */
class Hook extends BaseResource
{
    /**
     * @var
     */
    protected $id;

    protected $attributes = [];

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }
}