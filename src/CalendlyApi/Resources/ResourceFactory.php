<?php

namespace CalendlyApi\Resources;


use CalendlyApi\Exceptions\ModelNotFoundException;
use CalendlyApi\Models\ModelInterface;

/**
 * Class ResourceFactory
 * @package CalendlyApi\Resources
 */
class ResourceFactory
{

    /**
     * ResourceFactory constructor.
     */
    protected function __construct(){}

    /**
     * @param ModelInterface $model
     * @param $data
     * @param string $customResource\
     * @param string $parentVar
     * @return mixed
     * @throws ModelNotFoundException
     */
    public static function create($model, $data, $customResource = "", $parentVar = "") {
        $className = "CalendlyApi\\Resources\\" . ($customResource != "" ? $customResource : $model->getModelName());

        if (!class_exists($className)) {
            throw new ModelNotFoundException($className);
        }

        if($parentVar != "") {
            if(!isset($data[$parentVar])) {
                throw new \InvalidArgumentException("{$parentVar} not found in data {$customResource} resource");
            }

            $data = $data[$parentVar];
        }

        if(method_exists($className, "setResponseData")) {
            $data = ["responseData" => $data];
        }

        if (array_key_exists(0, $data)) {

            foreach ($data as $i => $itemArray) {

                if (is_array($itemArray)) {
                    $data[$i] = new $className($model, $itemArray);
                }
            }
        } else {
            $data = new $className($model, $data);
        }

        return $data;
    }
}