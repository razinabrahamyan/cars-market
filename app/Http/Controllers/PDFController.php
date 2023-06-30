<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Program;
use App\Services\Programs\ResidualValuesService;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Smalot\PdfParser\Parser;

class PDFController extends Controller
{
    /**
     * @var string[]
     * Mercedes-Benz models array
     */
    protected $mercedesClasses = ['A', 'C', 'CLA', 'E', 'CLS', 'S', 'GT', 'GLA', 'GLB', 'GLC', 'GLE', 'GLS', 'G'];

    /**
     * @var string[]
     */
    protected $tableFields = ['Model', '24', '30', '36', '42', '48', '54', '60', 'MRM', 'Model Year'];

    /**
     * @var ResidualValuesService
     */
    protected $residualService;

    /**
     * PDFController constructor.
     * @param ResidualValuesService $service
     */
    public function __construct(ResidualValuesService $service)
    {
        $this->residualService = $service;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function index(): string
    {
        $classes = $this->mercedesClasses;

        /**
         * For passing data to DB
         */
        $output = [];

        $filename = public_path('uploads/23.pdf');
        $parser = new Parser();
        $pdf = $parser->parseFile($filename);
        $pages = $pdf->getPages();

        $creationDate = $pdf->getDetails()['CreationDate'];
        $date = new Carbon($creationDate);
        $year = $date->year;

        $final_array = [];
        $resValAdjMatch = [];
        $moneyFactors = [];

        foreach ($pages as $key => $page) {
//            if($key ==2 ){
//                dd( $page->getText());
//            }
            $exist = preg_match('/^Model Year/m', $page->getText(), $matches);
            if ($exist > 0) {
                preg_match_all('/([a-zA-Z0-9]{1,}) ([0-9]{2}%) ([0-9]{2}%) ([0-9]{2}%) ([0-9]{2}%) ([0-9]{2}%) ([0-9]{2}%) ([0-9]{2}%) (-|\$[0-9]{1,}?,[0-9]{1,})/',
                    $page->getText(),
                    $matches
                );

                for ($i = 0; $i < count($matches[0]); $i++) {
                    $pieces = explode(" ", $matches[0][$i]);
                    array_push($final_array, $pieces);
                }

                preg_match_all('/\n(\d{1,},\d{1,}).*?\n?.*?(add|subtract) .*?(\d%) .*?\((.*?)\)/',
                    $page->getText(),
                    $match
                );
                if (empty($resValAdjMatch)) {
                    $resValAdjMatch = $match;
                }
            }

            /*Money Factor Parsing*/
            $moneyFactoryPageCheck = preg_match('/Programs.*&?.*Offers/m', $page->getText(), $matches);
            if ($moneyFactoryPageCheck > 0) {
                preg_match_all('/(.*?)\s(std\.|\d\.\d{1,}).*(N\/A|\$.*?)\s(N\/A|\$.*?)\s(N\/A|\$.*?)\s(N\/A|\$.*?)\s(N\/A|\$.*?)\s(N\/A|\$.*?)\s(N\/A|\$.*?)\sTBD/',
                    $page->getText(),
                    $matches
                );
                if (!empty($matches)) {
                    unset($matches[0]);
                    foreach ($matches[1] as $mfkey => $match) {
                        $MFYear = (empty($moneyFactors[$year][$matches[1][$mfkey]])) ? $year : $year + 1;

                        //this explode fix bug with double model result in parsing
                        $explode = explode(' ',$matches[1][$mfkey]);
                        $matches[1][$mfkey] = (!empty($explode[1])) ? $explode[1] : $explode[0];

                        $moneyFactors[$MFYear][$matches[1][$mfkey]] = [
//                            'model'          => $matches[1][$mfkey],
                            'A1_T1'          => $matches[2][$mfkey],
                            'incentiveBonus' => preg_replace('/[^0-9]/', '', $matches[3][$mfkey]),
                            'leaseBonusCash' => preg_replace('/[^0-9]/', '', $matches[3][$mfkey]),
                            'fleetIncentive' => preg_replace('/[^0-9]/', '', $matches[7][$mfkey]),
                        ];
                    }
                }
            }
            /*Money Factor Parsing*/

        }

        $residualValuesAdjustments = $this->addValuesAdjustments($resValAdjMatch);

        for ($j = 0; $j < count($final_array); $j++) {
            for ($n = 0; $n < count($classes); $n++) {
                $pos = strpos($final_array[$j][0], $classes[$n]);
                if ($pos === false) {
                    continue;
                } else if ($pos === 0) {
                    $mutated_year = $this->checkExistingModelName($output, $classes[$n], $year, $final_array[$j][0]);
                    if ($classes[$n] === 'C' || $classes[$n] === 'G') {
                        $numeric = is_numeric(substr($final_array[$j][0], 1, 1));
                        if ($numeric) {
                            $final_array[$j][] = $mutated_year;
                            $output[$classes[$n]][] = $final_array[$j];
                        }
                    } else {
                        $final_array[$j][] = $mutated_year;
                        $output[$classes[$n]][] = $final_array[$j];
                    }

                }
            }
        }

        return $this->createOrUpdate($output, $residualValuesAdjustments, $moneyFactors);
    }

    /**
     * @param $rvam
     * @return array
     */
    private function addValuesAdjustments($rvam): array
    {
        $rva = [];
        $naming = ['miles', 'action', 'percent', 'terms'];
        for ($value_adjustments = 1; $value_adjustments < count($rvam); $value_adjustments++) {
            foreach ($rvam[$value_adjustments] as $item) {
                $rva[$naming[$value_adjustments - 1]][] = $item;
            }
        }

        return $rva;
    }

    /**
     * @param $array
     * @param $modelsClasses
     * @param $year
     * @param $same
     * @return string
     */
    private function checkExistingModelName($array, $modelsClasses, $year, $same): string
    {
        if (count($array) > 0) {
            if (isset($array[$modelsClasses])) {
                foreach ($array[$modelsClasses] as $item) {
                    if ($item[0] === $same) {
                        return $year += 1;
                    }
                }
            }

        }
        return $year;

    }

    /**
     * @param $data
     * @param $adjustments
     * @return Application|RedirectResponse|Redirector
     */
    private function createOrUpdate($data, $adjustments, $moneyFactors)
    {
        $modelsData = [];

        foreach ($data as $key => $item) {
            $modelsData[$key] = $item;
        }

        $modelsData['fields'] = $this->tableFields;
        $modelsData['values_adjustments'] = $adjustments;

        $combine = json_encode($modelsData);

        $brand = Brand::query()->whereBrand('Mercedes-Benz')->first();

        if ($brand->program) {
            $brand->program()->update([
                'residual_values' => $combine,
                'money_factor'    => $moneyFactors,
            ]);
        } else {
            $program = new Program();
            $program->residual_values = $combine;
            $program->money_factor = $moneyFactors;
            $brand->program()->save($program);
        }

//        dd($this->residualService->searchModel($brand->id, 'GLE'));
        return redirect('/');
    }

}
