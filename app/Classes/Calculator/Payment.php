<?php


namespace App\Classes\Calculator;


use Illuminate\Support\Arr;

class Payment
{
    protected $data;

    public function __construct(array $data)
    {
        $final_data = [];
        $final_data['msrp'] = Arr::exists($data,'msrp')? $data['msrp'] :null;
        $final_data['rebates'] = Arr::exists($data,'rebates')? $data['rebates'] :0;
        $final_data['discount'] = Arr::exists($data,'discount')? $data['discount'] :0;
        $final_data['residualValuePercent'] = Arr::exists($data,'residualValuePercent')? $data['residualValuePercent'] :null;
        $final_data['term'] = Arr::exists($data,'term')? $data['term'] :24;
        $final_data['moneyFactor'] = Arr::exists($data,'moneyFactor')? $data['moneyFactor'] :null;
        $final_data['miles'] = Arr::exists($data,'miles')? $data['miles'] :15000;
        $this->data = $final_data;
    }

    /**
     * calculates total montyly payment for lease
     * @return float|int
     */
    public function calculate(){
        $data = $this->data;
        $residualValue = $this->getResidualValue();
        $sellingPrice =  $this->getSellingPrice();
        $totalPayment = $sellingPrice - $residualValue;
        $monthlyPayment = $this->getMonthlyPayment($totalPayment);
        $monthlyMoneyFactor =  $this->getMonthlyMoneyFactor($sellingPrice, $residualValue);
        $totalMonthlyPayment = $monthlyMoneyFactor + $monthlyPayment;
        return round($totalMonthlyPayment, 2);
    }

    /**
     * returns monthly money factor of a car for a lease
     * @param $sellingPrice
     * @param $residualValue
     * @return float|int
     */
    public function getMonthlyMoneyFactor($sellingPrice, $residualValue){
        return ($sellingPrice + $residualValue) * $this->data['moneyFactor'];
    }

    /**
     * returns monthly payment for a car for a lease
     * @param $totalPayment
     * @return float|int
     */
    public function getMonthlyPayment($totalPayment){
        return $totalPayment / $this->data['term'];
    }
    /**
     * returns selling price of a car for a lease
     * @return mixed
     */
    public function getSellingPrice(){
        $data = $this->data;
        return $data['msrp'] - $data['rebates'] - $data['discount'];
    }

    /**
     * returns residual value of a car depending on mile program of the lease
     * @return float|int
     */
    public function getResidualValue(){
        $data = $this->data;
        $percent = $data['residualValuePercent'];
        switch($data['miles']){
            case 7500:
                $percent += 4;
                break;
            case 10000:
                $percent += 3;
                break;
            case 12000:
                $percent += 2;
                break;
            case 20000:
                $percent -= 5;
                break;
        }
        return ($data['msrp'] * $percent) / 100;

    }
}

