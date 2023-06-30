<?php

namespace App\Classes\Vin\Helpers\ModelFormatting;

use App\Classes\Vin\Helpers\ModelFormatting\Types;
use App\Models\Vin;

class ModelFormatting
{
    private $data;

    /**
     * @param \App\Models\Vin $vin
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    public function formatter()
    {
        $fullBrand = '';
        $brand = $this->data['brand'];

        $namespace = 'App\Classes\Vin\Helpers\ModelFormatting\Types';

        $objectClass = $namespace.'\ModelFormatting'.preg_replace('/[^\p{L}\p{N}\s]/u', '', $brand);
        if (class_exists($objectClass)) {
            $fullBrand = (new $objectClass($this->data))->prepareModelTrim();
        }

        return $fullBrand;
    }
}
