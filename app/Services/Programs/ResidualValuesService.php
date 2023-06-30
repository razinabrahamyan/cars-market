<?php

namespace App\Services\Programs;

use App\Models\Brand;

class ResidualValuesService
{
    public function searchModel(int $brandId, string $model)
    {
        $class = '';
        foreach (preg_split('//', $model, -1, PREG_SPLIT_NO_EMPTY) as $name) {if (is_numeric($name))
        {break;}
        else {$class.= $name;}}

        $brand = Brand::query()->whereId($brandId)->with('program')->first();
        $jsonVal = $brand->program->select("residual_values->$class as data", "residual_values->fields as fields")->first();
        $data = json_decode($jsonVal->data);
        $input = preg_quote($model, '~');
        $output = [];
        if ($data) {
            foreach ($data as $item) {
                $result = preg_grep('~' . $input . '~', $item);
                if (count($result) > 0) {
                    array_push($output, $item);
                }
            }
        }

        $tableFields = json_decode($jsonVal->fields);
        $finalOutput = [];
        foreach ($output as $value) {
            array_push($finalOutput, array_combine($tableFields, $value));
        }

        return $finalOutput;

    }
}