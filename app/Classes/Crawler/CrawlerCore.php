<?php

namespace App\Classes\Crawler;

use App\Classes\Crawler\CrawlTypes\RegExp;
use App\Classes\Vin\Decoder\VinDecoder;
use App\Classes\Vin\Helpers\ClearModel;
use App\Classes\Vin\Helpers\ModelFormatting\ModelFormatting;
use App\Models\Brand;
use App\Models\Vin;
use App\Models\WebCrawler;
use App\Services\Programs\ProgramService;
use GuzzleHttp\Exception\GuzzleException;

class CrawlerCore
{
    protected $vin;
    protected $crawledData = [];
    protected $savedData = [];
    protected $decodedVIN = [];

    /**
     * @param $vin
     */
    public function __construct($vin)
    {
        $this->vin = $vin;
        $this->decodedVIN = VinDecoder::decodeVin($vin);
    }

    /**
     * Start Web Crawling and VIN Decoding
     */
    public function startCrawling()
    {
        //Decode Vin and try find brand in DB
        $decodedVin = $this->decodedVIN;
        $brand = Brand::where('brand', $decodedVin['brand'])->first();

        //If we could not find data from basic url
        $getBrandCrawlingUrls = WebCrawler::whereRaw('JSON_CONTAINS(brands, ?)', [json_encode($brand->id)])->get();
        $result = $this->crawlUrls($getBrandCrawlingUrls);

        //Get Crawling options for basic urls
        if ((empty($result['msrp'])) && !empty($brand->id)) {
            $getCrawlingUrls = WebCrawler::where('priority', '!=', 0)->orderBy('priority', 'DESC')->get();
            $result = $this->crawlUrls($getCrawlingUrls);
        }

        //Preparing data for saving
        $this->crawledData = $result;

        //Initiate VIN data saving
        return $this->saveCrawledData();
    }

    /**
     * Saving Crawled Data in DataBase
     */
    public function saveCrawledData()
    {
        if (!empty($this->crawledData) && !empty($this->crawledData["msrp"]) && !empty($this->crawledData["model"])) {
            $msrp = preg_replace("/[^0-9]/", '', $this->crawledData["msrp"]);

            if (!empty($msrp)) {
                $clearModel = (new ClearModel($this->crawledData["model"]))->clear();

                return Vin::updateOrCreate([
                    "vin" => $this->vin,
                ], [
                    "vin"             => $this->vin,
                    "msrp"            => $msrp,
                    "brand"           => $this->crawledData['brand'],
                    "model"           => $this->crawledData["model"],
                    "clear_model"     => $clearModel,
                    "year"            => $this->crawledData["year"],
                    "options"         => [
                        "drive_train" => $this->crawledData["drive_train"] ?? '',
                        "body_style"  => $this->crawledData["body_style"] ?? '',
                        "exterior"    => $this->crawledData["exterior"] ?? '',
                        "interior"    => $this->crawledData["interior"] ?? '',
                        "image"       => $this->crawledData["image"] ?? '',
                    ],
                    "program_checked" => $this->crawledData["program_checked"] ?? false,
                ]);
            }
        }

        return false;
    }

    /**
     * Prepare URLs for Web Crawling
     * @param $urls
     * @return array
     */
    public function crawlUrls($urls) : array
    {
        $checkedResult = $result = [];

        //Start web crawling until we find MSRP
        foreach ($urls as $url) {
            $result['url_id'] = $url->id;
            $pageUrl = str_replace("{vin}", $this->vin, $url->url);
            try {
                $result = (new CrawlerFactory(new RegExp()))->setPageUrl($pageUrl)
                                                            ->setQuery($url->regexp)
                                                            ->crawl();
            } catch (GuzzleException $exception) {

            }

            $result['model'] = (new ClearModel($result['model']))->clear();
            $result['crawling_url'] = $url->url;
            $result['year'] = $this->decodedVIN['year'];
            $result['brand'] = !empty($result['brand']) ? $result['brand'] : $this->decodedVIN['brand'];

            //If image doesn't contain host name, then we add crawled url
            if (!empty($result["image"]) && !strpos($result["image"], "http://")) {
                $result["image"] = '//'.parse_url($result['crawling_url'])['host'].$result["image"];
            }

            if (!empty($result['msrp']) && !empty($result['model'])) {
                $result['program_checked'] = $this->checkProgram($result);
                $checkedResult = $result;
                break;
            }
        }

        return $checkedResult;
    }

    public function checkProgram($data)
    {
        $formattedModel = (new ModelFormatting($data))->formatter();
        $brand = Brand::where('brand', $data['brand'])->with('program')->first();

        $program = new ProgramService($brand, $formattedModel);
        $residualValueByYear = collect($program->searchResidualValue())->groupBy('Model Year')->get($data['year']);
        if (!empty($residualValueByYear)) {
            return true;
        }

        return false;
    }
}
