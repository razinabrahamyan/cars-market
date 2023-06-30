<?php

namespace Database\Seeders;

use App\Models\WebCrawler;
use Illuminate\Database\Seeder;

class WebCrawlerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inserts = [
            [
                'url'        => 'https://www.capitalone.com/cars/vehicle-details/2021/Lexus/GX/460+Premium/{vin}',
                'priority'   => 10000,
                'brands'     => ['*'],
                'regexp'     => [
                    'msrp'        => '/<div class="vehicle-value__price ng-star-inserted"><span>\$<\/span><span> (.*) <\/span><\/div>/',
                    'image'       => '/src="(https:\/\/autoimage\.capitalone\.com\/(.*?))"/',
                    'brand'       => '/<h1 class="vehicle-info"><span class="vehicle-info__year-make-model">.* (\D{1,})<\/span><span class="vehicle-info__trim">/',
                    'model'       => '/<span class="vehicle-info__trim">(.*?) For Sale<\/span>/',
                    'exterior'    => '/Exterior Color.*?ng-star-inserted">(.*?)<\/span>/',
                    'interior'    => '/Interior Color.*?ng-star-inserted">(.*?)<\/span>/',
                    'drive_train' => '/Drive Train.*?ng-star-inserted">(.*?)<\/span>/',
                    'body_style'  => '/Body Style.*?ng-star-inserted">(.*?)<\/span>/',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'url'        => 'https://www.dealerrater.com/classifieds/2011-Volvo-C30-ad-{vin}-112285/',
                'priority'   => 9990,
                'brands'     => ['*'],
                'regexp'     => [
                    'msrp'     => '/<span class="notranslate">\$(.*?)<\/span>/',
                    'image'    => '/<div class="item active" data-slide-number="0">.+?<img class="" src="(.*?)"/s',
                    'brand'    => '/<h1 class="h1-header line-height-125" itemprop="name">.* (.*) .*?<\/h1>/s',
                    'model'    => '/<h1 class="h1-header line-height-125" itemprop="name">.* .* (.*?)<\/h1>/s',
                    'exterior' => '/Exterior Color.*?class="td font-16 capitalize">(.*?)<\/div/s',
                    'interior' => '/Interior Color.*?class="td font-16 capitalize">(.*?)<\/div/s',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'url'        => 'https://www.truecar.com/new-cars-for-sale/listing/{vin}/',
                'priority'   => 9980,
                'brands'     => ['*'],
                'regexp'     => [
                    'msrp'        => '/MSRP<\/div><p class="margin-top-1">(.*?)<\/p><\/div>/ms',
                    'image'       => '/<div class="img-container img-container-block _15ssgi".*?<img sizes="600px" src="(.*?)"/ms',
                    'model'       => '/<div class="heading-base" data-qa="Heading">(.*?)<\/div>/s',
                    'brand'       => '/<div class="heading-2" data-qa="Heading">.* (.*?)(\s|&nbsp;).*?<\/div>/s',
                    'exterior'    => '/Exterior Color<\/div><p class="font-size-3">(.*?)<\/p>/s',
                    'interior'    => '/Interior Color<\/div><p class="font-size-3">(.*?)<\/p>/s',
                    'drive_train' => '/Drive Type<\/div><p class="font-size-3">(.*?)<\/p>/s',
                    'body_style'  => '/Style<\/div><p class="font-size-3">(.*?)<\/p>/s',
                ],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
              'url' => 'https://www.mbofbrooklyn.com/new-Brooklyn-2021-Mercedes+Benz-+-S+580+4MATIC-{vin}',
              'priority'   => 0,
              'brands'     => [190],
              'regexp'     => [
                  'msrp'        => '/<div class="vdp--sidebarPriceTab__container">.*?<span class="priceBlockItemPriceLabel">MSRP: <\/span><span class="pull-right">(.*?)<\/span>/ms',
                  'image'       => '/<div class="carousel__item js-carousel__item ".*?<img src="(.*?)"/ms',
                  'model'       => '/Model Code: (.*?)</s',
                  'brand'       => '/(Mercedes-Benz)/s',
                  'exterior'    => '/Ext\. Color \/ Int\. Color.*?<h3 class="h5 strong vdp-info-body-title">(.*?)\/.*?<\/h3>/s',
                  'interior'    => '/Ext\. Color \/ Int\. Color.*?<h3 class="h5 strong vdp-info-body-title">.*?\/(.*?)<\/h3>/s',
                  'drive_train' => '/Drive Type<\/span>.*?<h3 class="h5 strong vdp-info-body-title">.*? \/? (.*?)<\/h3>/s',
                  'body_style'  => '/Body Style.*?<h3 class="h5 strong vdp-info-body-title">\d{1,}D (.*?)<\/h3>/s',
              ],
              'created_at' => now(),
              'updated_at' => now(),
            ],
        ];
        foreach ($inserts as $insert) {
            WebCrawler::create($insert);
        }
    }
}
