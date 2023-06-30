<?php

namespace App\Classes\Vin\Decoder;

use App\Models\Wmi;

class VinDecoder
{
    public static function decodeVin($vin)
    {
        $vin = trim($vin);

        $firstTwoDigits = substr($vin, 0, 2);
        $firstThreeDigits = substr($vin, 0, 3);
        $tenthDigits = substr($vin, 9, 1);

        $wmi = Wmi::where('wmi', $firstThreeDigits)->orWhere('wmi', $firstTwoDigits)->first();

        $result = [
            "wmi"     => $wmi->wmi ?? null,
            "brand"   => !empty($wmi->brand) ? $wmi->brand->brand : null,
            "country" => $wmi->country ?? null,
            "year"    => Constatnts::YEARS[$tenthDigits] ?? null,
        ];

        return $result;
    }
}
