<?php

namespace App\Classes\Vin\Helpers;

use App\Models\Vin;

class ClearModel
{
    protected $vin;
    protected $model = '';
    protected $clearModel = '';

    /**
     * @param $vin
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function clear()
    {
        $this->clearModel();
        $this->clearYear($this->clearModel);
        return str_replace(' ','',trim($this->clearModel));
    }

    public function clearModel()
    {
        $model = $this->model;

        $clearWord = [
            "Cabriolet",
            "Convertible",
            "Coupe",
            "Hatchback",
            "Sedan",
            "SUV",
            "Truck",
            "Minivan",
            "Van",
            "Wagon",
            "AMG",
            "Maybach",
            "4MATIC",
        ];

        $clearRegExps = [
            '/[a-zA-Z]-Class/s',
        ];

        foreach ($clearRegExps as $clearRegExp) {
            $clear = preg_replace($clearRegExp, '', $model);
        }
        $clearWords = str_replace($clearWord, '', $clear);


        $this->clearModel = $clearWords;

        return $clearWords;
    }

    public function clearYear($model)
    {
        $clear = preg_replace('/20\d\d/', '', $model);
        $this->clearModel = $clear;
        return $clear;
    }
}
