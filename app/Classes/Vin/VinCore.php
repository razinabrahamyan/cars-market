<?php

namespace App\Classes\Vin;

use App\Classes\Crawler\CrawlerCore;
use App\Classes\MarketCheck\MarketCheckHandler;
use App\Models\Vin;
use Exception;
use Illuminate\Support\Carbon;

class VinCore
{
    protected $vin;
    protected $vinObject = null;
    protected $data;
    protected $useApi;

    /**
     * @param $vin
     */
    public function __construct($vin, $useApi = false)
    {
        $this->vin = $vin;
        $this->useApi = $useApi;
    }

    public function searchData()
    {
        $checkVinInDB = $this->checkVinInDB();
        if (!empty($checkVinInDB)) {
            $this->vinObject = $checkVinInDB;
            $this->data = $this->formatDBData($this->vinObject);
        } else {
            try {
                $this->vinObject = (new CrawlerCore($this->vin))->startCrawling();
                if ($this->checkCrawlData($this->vinObject)) {
                    $this->data = $this->formatDBData($this->vinObject);
                }
            } catch (Exception $exception) {
                //Send Exception to Email and write in the log
            }
        }

        if ($this->useApi) { //Check if we want use API for VIN search
            if (empty($this->vinObject)) { //Activate API only if we couldn't find DATA by crawling
                try {
                    $marketCheck = new MarketCheckHandler($this->vin);
                    $findVehicle = $marketCheck->findVehicle(true);
                    $this->vinObject = $marketCheck->getVinObject();

                    if ($this->checkCrawlData($this->vinObject)) {
                        $this->data = $this->formatDBData($this->vinObject);
                    }
                } catch (Exception $exception) {
                    //Send Exception to Email and write in the log
                }
            }
        }

        return $this;
    }

    public function checkVinInDB()
    {
        return Vin::where('vin', $this->vin)
                  ->where('created_at', '>=', Carbon::now()->subDays(7)->toDateTimeString())->first();
    }

    public function checkCrawlData($crawl) : bool
    {
        return (!empty($crawl['msrp']) && !empty($crawl['model']));
    }

    public function formatDBData($data) : array
    {
        return [
            "vin"     => $this->vin ?? null,
            "msrp"    => $data->msrp ?? null,
            "brand"   => $data->brand ?? null,
            "model"   => $data->model ?? null,
            "year"    => $data->year ?? null,
            "options" => $data->options ?? null,
        ];
    }

    public function formatAPIData($data)
    {

    }

    /**
     * @return mixed
     */
    public function getVinObject()
    {
        return $this->vinObject;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
