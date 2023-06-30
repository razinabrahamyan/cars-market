<?php

namespace App\Classes\Vin\Helpers\ModelFormatting\Types;

use App\Models\Vin;

class ModelFormattingMercedesBenz
{
    const C_FORMATE = ['coupe', 'convertible', 'cabriolet'];
    private $vin;

    /**
     * @param $vin
     */
    public function __construct($data)
    {
        $this->vin = $data;
    }

    public function prepareModelTrim()
    {
        $vin = $this->vin;

        $driveTrainIndex = $bodyStyleIndex = '';
        $model = !empty($vin['clear_model']) ? $vin['clear_model'] : $vin['model'];
        $model = str_replace(' ', '', $model);

        $driveTrain = strtolower($vin["drive_train"]) ?? '';
        $bodyStyle = strtolower($vin["body_style"]) ?? '';


        switch ($driveTrain) {
            case "awd":
            case "all-wheel drive":
            case "all wheel drive":
            case "4wd":
            {
                $driveTrainIndex = '4';
                break;
            }
        }

        switch ($bodyStyle) {
            case "sedan":
            case "suv":
            case "4d sport utility":
            case "2d sport utility":
            case "sport utility":
            {
                if (substr($model, 0, 1) == 'S') { //If Mercedes Class S Then trim changing from "W" to "V"
                    $bodyStyleIndex = 'V';
                } elseif (substr($model, 0, 3) == 'CLA') {
                    $bodyStyleIndex = 'C';
                } else {
                    $bodyStyleIndex = 'W';
                }

                break;
            }
            case "coupe":
            {
                $bodyStyleIndex = 'C';
                break;
            }
            case "convertible":
            case "cabriolet":
            {
                $bodyStyleIndex = 'A';
                break;
            }
            case "maybach":
            {
                $bodyStyleIndex = 'Z';
                break;
            }
            case "van":
            case "wagon":
            {
                $bodyStyleIndex = 'S';
                break;
            }
            case "limousine":
            {
                $bodyStyleIndex = 'V';
                break;
            }
        }

        if (!empty($bodyStyleIndex) && empty($driveTrainIndex)) {
            $driveTrainIndex = 4;
        }

        return $model.$bodyStyleIndex.$driveTrainIndex;
    }

    public function specialModelClear()
    {

    }
}
