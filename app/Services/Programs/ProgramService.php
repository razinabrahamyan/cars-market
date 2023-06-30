<?php

namespace App\Services\Programs;

use App\Models\Brand;

class ProgramService
{
    protected $brandId;
    protected $model;
    protected $brand;

    /**
     * @param $brandId
     * @param $model
     */
    public function __construct(Brand $brand, string $model)
    {
        $this->model = $model;
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function searchMoneyFactor($year, $customModel = '')
    {
        $model = $customModel ?? $this->model;

        //Searching Money Factor By Model
        $brand = $this->brand;

        $jsonVal = $brand->program->select("money_factor->$year as year")->first();
        if (!empty($jsonVal->year)) {
            $data = json_decode($jsonVal->year, 1)[$model];
        }

        if (!empty($data)) {
            $data['A1_T1'] = doubleval($data['A1_T1']);
            //If Money Factor Empty - Set Default Value
            if (!is_double($data['A1_T1']) || $data['A1_T1'] == 0.0) {
                $data['A1_T1'] = $brand->program->default_money_factor;
            }
        }

        return $data;
    }

    public function searchInvoice()
    {
        $invoice = 0;
        $model = $this->model;

        $class = '';
        foreach (preg_split('//', $model, -1, PREG_SPLIT_NO_EMPTY) as $name) {
            if (is_numeric($name)) {
                break;
            } else {
                $class .= $name;
            }
        }

        $brand = $this->brand;
        if (!empty($brand->program)) {
            $jsonVal = $brand->program->select("invoices->$class as data")->first();
            $invoice = json_decode($jsonVal->data);
        }

        return $invoice;
    }

    public function searchResidualValue()
    {
        $finalOutput = [];
        $model = $this->model;

        $class = '';
        foreach (preg_split('//', $model, -1, PREG_SPLIT_NO_EMPTY) as $name) {
            if (is_numeric($name)) {
                break;
            } else {
                $class .= $name;
            }
        }

        $brand = $this->brand;
        if (!empty($brand->program)) {
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
            foreach ($output as $value) {
                array_push($finalOutput, array_combine($tableFields, $value));
            }
        }

        return $finalOutput;
    }
}
