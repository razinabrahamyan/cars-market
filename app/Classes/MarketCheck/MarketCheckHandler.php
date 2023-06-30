<?php

namespace App\Classes\MarketCheck;

use App\Classes\MarketCheck\Api\MarketCheckApi;
use App\Classes\Vin\Helpers\ClearModel;
use App\Models\Vin;

class MarketCheckHandler
{
    protected $vin;
    protected $vinObject;

    /**
     * @param $vin
     */
    public function __construct($vin)
    {
        $this->vin = $vin;
    }

    /**
     * Search Vehicle Specifications By API
     * @param false $withSave
     * @return array
     */
    public function findVehicle(bool $withSave = false)
    {
        $result = [];

        //Set VIN and prepare API
        $marketCheckApi = (new MarketCheckApi())->setVin($this->vin);
        //Search vehicle history to get hashed VIN
        $carHistory = $marketCheckApi->getCarHistory();
        //Search vehicle by hashed VIN nubmer
        $carListing = $marketCheckApi->getCarListing();

        //Preparing vehicle Data for save in DB
        if (!empty($carListing)) {
            $clearModel = (new ClearModel($carListing['build']['trim']))->clear();

            $result = [
                "vin"         => $carListing['vin'],
                "msrp"        => $carListing['msrp'],
                "brand"       => $carListing['build']['make'],
                "model"       => $carListing['build']['trim'],
                "clear_model" => $clearModel,
                "year"        => $carListing['build']["year"],
                "options"     => [
                    "drive_train" => $carListing['build']['drivetrain'] ?? '',
                    "body_style"  => $carListing['build']['body_type'] ?? '',
                    "exterior"    => $carListing['build']['exterior_color'] ?? '',
                    "interior"    => '',
                    "image"       => $carListing["media"]["photo_links"][0] ?? '',
                ],
            ];
        }

        //Init saving in DB
        if ($withSave) {
            $this->vinObject = $this->saveVIN($result);
        }

        return $result;
    }

    /**
     * Method for saving vehicle specifications in DB
     * @param $params
     * @return false
     */
    protected function saveVIN($params)
    {
        //If required vehicle params are not empty, then start saving
        if (!empty($params) && !empty($params["msrp"]) && !empty($params["model"])) {
            $msrp = preg_replace("/[^0-9]/", '', $params["msrp"]);

            if (!empty($msrp)) {
                $params['is_api'] = true;
                return Vin::updateOrCreate([
                    "vin" => $this->vin,
                ], $params);
            }
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getVinObject()
    {
        return $this->vinObject;
    }
}
