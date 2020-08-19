<?php

namespace CalendlyApi\Responses\Interfaces;


/**
 * Interface ResponseInterface
 * @package CalendlyApi\Responses\Interfaces
 */
interface ResponseInterface
{
    /**
     * @return mixed
     */
    public function getBody();

    /**
     * @return mixed
     */
    public function getCode();

    /**
     * @return mixed
     */
    public function getHeaders();

    /**
     * @return array
     */
    public function getArray() : array;
}