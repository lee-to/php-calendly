<?php

namespace CalendlyApi\Auth;


/**
 * Interface AuthInterface
 * @package CalendlyApi\Auth
 */
interface AuthInterface
{
    /**
     * @return array
     */
    public function getHeaders() : array;
}