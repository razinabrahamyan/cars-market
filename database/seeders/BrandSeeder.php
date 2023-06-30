<?php

namespace Database\Seeders;

use App\Classes\Vin\Decoder\Constatnts;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = Constatnts::BRAND_BY_VIN;
        $brands = [];
        foreach ($countries as $country => $wmis) {
            foreach ($wmis as $wmi => $brand) {
                $brands[$brand] = [
                    'brand'      => $brand,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        $brands[] = [
            'brand'      => 'Lexus',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        Brand::insert($brands);
    }
}
