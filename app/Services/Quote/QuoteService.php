<?php

namespace App\Services\Quote;

use App\Classes\Helpers\SourceChecker;
use App\Classes\Vin\Helpers\ModelFormatting\ModelFormatting;
use App\Classes\Vin\VinCore;
use App\Models\Brand;
use App\Services\Programs\ProgramService;

class QuoteService
{
    protected $vin;

    /**
     * @param $vin
     */
    public function __construct($vin)
    {
        $this->vin = $vin;
    }

    public function minimalQuoteData()
    {
        $invoice = 0;
        $formattedModel = '';
        $residualValue = $moneyFactor = [];

        $crawl = (new VinCore($this->vin, true))->searchData()->getVinObject();

        if (!empty($crawl)) {
            $formattedModel = (new ModelFormatting([
                "brand"       => $crawl->brand,
                "clear_model" => $crawl->clear_model,
                "model"       => $crawl->model,
                "drive_train" => $crawl->options['drive_train'] ?? '',
                "body_style"  => $crawl->options['body_style'] ?? '',
            ]))->formatter();

            $brand = Brand::where('brand', $crawl->brand)->with('program')->first();

            $program = new ProgramService($brand, $formattedModel);

            $residualValueByYear = collect($program->searchResidualValue())->groupBy('Model Year')->get($crawl->year);
            if (!empty($residualValueByYear)) {
                $residualValue = $residualValueByYear->first();
                $moneyFactor = $program->searchMoneyFactor($crawl->year, $residualValue['Model']);
            }
            $invoice = $program->searchInvoice() ?? $brand->program->default_invoice;
        }

        //Clear Data if its not "month=>percent" (remove this shit in future)
        $clearedResidualValues = [];
        foreach ($residualValue as $key => $item) {
            if (in_array($key, [24, 30, 36, 42, 48, 54, 60])) {
                $clearedResidualValues[$key] = intval(preg_replace("/[^0-9]/", '', $item));
            }
        }

        /*Crutch for months*/
        if (!empty($clearedResidualValues[36]) && !empty($clearedResidualValues[42])) {
            $clearedResidualValues[39] = floor(($clearedResidualValues[36] + $clearedResidualValues[42]) / 2);
        }
        ksort($clearedResidualValues);
        /*Crutch for months*/

        return [
            'model'          => $formattedModel,
            'crawl'          => $crawl,
            'rebatesList'    => [
                "incentiveBonus" => $moneyFactor['incentiveBonus'] ?? 0,
                "leaseBonusCash" => $moneyFactor['leaseBonusCash'] ?? 0,
                "fleetIncentive" => $moneyFactor['fleetIncentive'] ?? 0,
            ],
            'discount'       => 0,
            'residualValues' => $clearedResidualValues,
            'termArray'      => array_keys($clearedResidualValues),
            'moneyFactor'    => $moneyFactor['A1_T1'],
            'fees'           => $brand->program->fees,
            'invoice'        => $invoice,
            'image'          => !empty($crawl->options['image']) ? $crawl->options['image'] : asset('images/default/default_car.jpg'),
        ];
    }
}
