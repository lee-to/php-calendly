<?php

namespace CalendlyApi\Models\Traits;


/**
 * Trait DefaultModel
 * @package CalendlyApi\Models\Traits
 */
trait DefaultModel
{
    /**
     * @return bool|string
     */
    public function getModelName() {
        return substr(strrchr(get_class($this), "\\"), 1);
    }
}