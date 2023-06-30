<?php

namespace App\Http\Controllers;

use App\Classes\Calculator\Payment;
use App\Classes\Crawler\CrawlerCore;
use App\Classes\Crawler\CrawlerFactory;
use App\Classes\Crawler\CrawlTypes\RegExp;
use App\Classes\Helpers\SourceChecker;
use App\Classes\MarketCheck\Api\MarketCheckApi;
use App\Classes\MarketCheck\MarketCheckHandler;
use App\Classes\Vin\Decoder\VinDecoder;
use App\Classes\Vin\Helpers\ClearModel;
use App\Classes\Vin\VinCore;
use App\Classes\Vin\WebSiteConstants\Edmunds\Paths;
use App\Mail\UserQuoteMail;
use App\Models\Vin;
use App\Services\Quote\QuoteService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{
    public function edumndsRequset(){

    }

    public function spider()
    {
        set_time_limit(0);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.capitalone.com/cars/find/New+York-NY',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: EdmundsYear="&zip=58067&dma=724:IP&city=Rutland&state=ND&lat=46.054802&lon=-97.502278&userSet=false"; ak_bmsc=1310D682F1855272CAF3D4CE39B411C7~000000000000000000000000000000~YAAQlN5FaJ1Ihld8AQAAviYuYA3mYpqPw05Q7D0JbB2yVFVY/4pm6sMdjaIY4skDzSlZjyZ6X8GOksHBkJ3fPbFLaiw1VfFgV2L3YABNXKqwHzxJsTC1/SrTFXD65ZHwAdGUv+TUx8dVT11TQQbY5yu/yXD76VI2yj0B9wwRPDr0KyNVn5N3ZfyGz7/xQZjO8k4F1R1rsstCXwF9Vv9/9Otjuk+IrWrWwPkK9hUTpLvVzm5R3up3JcXJEp5rWdXVNwDQZwi+j+LUiNiQejOBy5Pswmgt8SjGK9g51GD/fl3A8R5q8X43Cc3+R23SBrgn5/iCL8wtx2b4oXRBZoKt+iEZwclzYBroGiIuESFpRz/G2flHKIeaSlFcRZmKGg==; edmunds=a34812be-63aa-4ac0-a265-cd4705e40a95; edw=966382017994982900; entry_page=home_page; entry_url=www.edmunds.com%2F; entry_url_params=%7B%7D; location=j%3A%7B%22zipCode%22%3A%2258067%22%2C%22type%22%3A%22Standard%22%2C%22areaCode%22%3A%22701%22%2C%22timeZone%22%3A%22Central%22%2C%22gmtOffset%22%3A-6%2C%22dst%22%3A%221%22%2C%22latitude%22%3A46.054802%2C%22longitude%22%3A-97.502278%2C%22salesTax%22%3A0.05%2C%22dma%22%3A%22724%22%2C%22dmaRank%22%3A114%2C%22stateCode%22%3A%22ND%22%2C%22city%22%3A%22Rutland%22%2C%22county%22%3A%22Sargent%22%2C%22inPilotDMA%22%3Atrue%2C%22state%22%3A%22North%20Dakota%22%2C%22userSet%22%3Afalse%2C%22ipZipCode%22%3A%2258067%22%2C%22ipDma%22%3A%22724%22%2C%22ipStateCode%22%3A%22ND%22%7D; session-id=966382017994982900; usprivacy=1YNN; visitor-id=a34812be-63aa-4ac0-a265-cd4705e40a95; content-targeting=RU,181,MOSCOW,,37.58,55.75,; device-characterization=false,false; feature-flags=j%3A%7B%7D'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        echo $response;
        $urlContent = $response;

        preg_match_all('/href="\/(.*?)"/i',$urlContent,$hrefs);

        $newHrefsArray = [];
        foreach ($hrefs[1] as $href){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.capitalone.com/'.$href,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Cookie: EdmundsYear="&zip=58067&dma=724:IP&city=Rutland&state=ND&lat=46.054802&lon=-97.502278&userSet=false"; ak_bmsc=1310D682F1855272CAF3D4CE39B411C7~000000000000000000000000000000~YAAQlN5FaJ1Ihld8AQAAviYuYA3mYpqPw05Q7D0JbB2yVFVY/4pm6sMdjaIY4skDzSlZjyZ6X8GOksHBkJ3fPbFLaiw1VfFgV2L3YABNXKqwHzxJsTC1/SrTFXD65ZHwAdGUv+TUx8dVT11TQQbY5yu/yXD76VI2yj0B9wwRPDr0KyNVn5N3ZfyGz7/xQZjO8k4F1R1rsstCXwF9Vv9/9Otjuk+IrWrWwPkK9hUTpLvVzm5R3up3JcXJEp5rWdXVNwDQZwi+j+LUiNiQejOBy5Pswmgt8SjGK9g51GD/fl3A8R5q8X43Cc3+R23SBrgn5/iCL8wtx2b4oXRBZoKt+iEZwclzYBroGiIuESFpRz/G2flHKIeaSlFcRZmKGg==; edmunds=a34812be-63aa-4ac0-a265-cd4705e40a95; edw=966382017994982900; entry_page=home_page; entry_url=www.edmunds.com%2F; entry_url_params=%7B%7D; location=j%3A%7B%22zipCode%22%3A%2258067%22%2C%22type%22%3A%22Standard%22%2C%22areaCode%22%3A%22701%22%2C%22timeZone%22%3A%22Central%22%2C%22gmtOffset%22%3A-6%2C%22dst%22%3A%221%22%2C%22latitude%22%3A46.054802%2C%22longitude%22%3A-97.502278%2C%22salesTax%22%3A0.05%2C%22dma%22%3A%22724%22%2C%22dmaRank%22%3A114%2C%22stateCode%22%3A%22ND%22%2C%22city%22%3A%22Rutland%22%2C%22county%22%3A%22Sargent%22%2C%22inPilotDMA%22%3Atrue%2C%22state%22%3A%22North%20Dakota%22%2C%22userSet%22%3Afalse%2C%22ipZipCode%22%3A%2258067%22%2C%22ipDma%22%3A%22724%22%2C%22ipStateCode%22%3A%22ND%22%7D; session-id=966382017994982900; usprivacy=1YNN; visitor-id=a34812be-63aa-4ac0-a265-cd4705e40a95; content-targeting=RU,181,MOSCOW,,37.58,55.75,; device-characterization=false,false; feature-flags=j%3A%7B%7D'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
//        echo $response;
            $newUrlContent = $response;
            preg_match_all('/href="\/(.*?)"/i',$newUrlContent,$newHrefs);

            preg_match_all('/href="\/(.*?)"/i',$urlContent,$newHrefs);
            $newHrefsArray[] = $newHrefs[1];
        }
        file_put_contents('hrefs.log',print_r($newHrefsArray,1),FILE_APPEND);

        dd('ok');
        $dom = new \DOMDocument();
        @$dom->loadHTML($urlContent);
        $xpath = new \DOMXPath($dom);
        $hrefs = $xpath->evaluate("/html/body//a");

        for($i = 0; $i < $hrefs->length; $i++){
            $href = $hrefs->item($i);
            $url = $href->getAttribute('href');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // validate url
            if(!filter_var($url, FILTER_VALIDATE_URL) === false){
                echo '<a href="'.$url.'">'.$url.'</a><br />';
//                dd('<a href="'.$url.'">'.$url.'</a><br />');
            }
        }
    }
    public function email()
    {
        return new UserQuoteMail([
            'image' => '//www.mbofbrooklyn.com/assets/stock/colormatched_01/white/640/cc_2021mbs71_01_640/cc_2021mbs710001_01_640_149.jpg?height=400',
            'model'          => 'GLA250W4',
            'msrp'           => 48235,
            'term'           => 24,
            'miles'          => 7500,
            'monthlyPayment' => 783,
        ]);
        Mail::to(['smnnartur1@gmail.com'])->send(new UserQuoteMail([
            'image' => '//www.mbofbrooklyn.com/assets/stock/colormatched_01/white/640/cc_2021mbs71_01_640/cc_2021mbs710001_01_640_149.jpg?height=400',
            'model'          => 'GLA250W4',
            'msrp'           => 48235,
            'term'           => 24,
            'miles'          => 7500,
            'monthlyPayment' => 783,
        ]));
    }

    public function api()
    {
//        $ar =(object) collect([
//            "vin"         => "W1K5J4HB2MN217998",
//            "msrp"        => 39850,
//            "brand"       => "Mercedes-Benz",
//            "model"       => "CLA250",
//            "clear_model" => "CLA250",
//            "year"        => 2021,
//            "options"     => [
//                "drive_train" => "4WD",
//                "body_style"  => "Sedan",
//                "exterior"    => "",
//                "interior"    => "",
//                "image"       => "https://invimg2.autofunds.net/InventoryImages/2021/08/09/4480_1876495_4560725_115909152021.jpg",
//            ],
//        ])->all();
//        $v = new VinCore("W1K5J4HB2MN217998");
//        dd($v->searchData()->);
//        dd($v->formatDBData($ar));
//        dd((new MarketCheckHandler('W1K5J4HB2MN217998'))->findVehicle(true));
//        $marketCheckApi = (new MarketCheckApi())->setVin('W1K5J4HB2MN217998');
//        $carHistory = $marketCheckApi->getCarHistory();
//        $carListing = $marketCheckApi->getCarListing();
//
////        dd($carHistory,$carListing);
//        if (!empty($carListing)) {
//            $clearModel = (new ClearModel($carListing['build']['trim']))->clear();
//
//            $result = [
//                "vin"         => $carListing['vin'],
//                "msrp"        => $carListing['msrp'],
//                "brand"       => $carListing['build']['make'],
//                "model"       => $carListing['build']['trim'],
//                "clear_model" => $clearModel,
//                "year"        => $carListing['build']["year"],
//                "options"     => [
//                    "drive_train" => $carListing['build']['drivetrain'] ?? '',
//                    "body_style"  => $carListing['build']['body_type'] ?? '',
//                    "exterior"    => $carListing['build']['exterior_color'] ?? '',
//                    "interior"    => '',
//                    "image"       => $carListing["media"]["photo_links"][0] ?? '',
//                ],
//            ];
//
//            if (!empty($result['msrp']) && !empty($result['model'])) {
////                $result['program_checked'] = $this->checkProgram($result);
//            }
//        }

    }

    public function vin()
    {
//        $vins = [
//            "W1KWJ8EB7MG098236",
//            "W1KWF8EB5MR647471",
//            "W1KWF8EB6MR646703",
//            "W1K5J4HB2MN217998",
//            "W1KZF8KB7MA994848",
//            "W1N4M4HB4MW142351",
//            "W1N4M4HB5MW145243",
//            "W1N0G8EB5MV317777",
//            "W1N0G8EB9MF994101",
//            "4JGFB4KB5MA577449",
//            "4JGFB4KB2MA573620",
//            "4JGFB4KB2MA574136",
//            "4JGFB5KB6MA555319",
//            "4JGFB5KB6MA555319",
//            "4JGFF5KE9MA565292",
//            "4JGFF5KE6MA575780",
//            "4JGFF5KE3MA572187",
//            "W1KWF8EB3MR646612",
//            "W1N4M4HB4MW142351",
//            "W1N4M4HB5MW145243",
//            "4JGFF8KE6MA576042",
//            "W1KWF8EB6MR646703",
//            "W1K6G6DB9MA032892",
//            "W1K6G6DB6MA032638",
//            "W1K6G6DBXMA031668",
//            "W1K6G6DB6MA033045",
//            "W1K6G7GB6MA043897",
//            "W1K6G7GB1MA048487",
//            "W1K6G7GB9MA044171",
//            "W1K6G7GB6MA019356",
//            "W1K6G7GB1MA019653",
//            "W1K6X7GB9MA037026",
//            "W1K6X7GBXMA047127",
//        ];
//
//        $dbVins = Vin::all()->pluck('vin')->toArray();
//        foreach ($vins as $vin){
//            if (!in_array($vin,$dbVins)){
//                dump($vin);
//            }
//        }
//        dd(file_get_contents('https://www.truecar.com/new-cars-for-sale/listing/'.$vin.'/2021-mercedes-benz-s-class/'));
//        dd((new QuoteService($vin))->minimalQuoteData());
//        foreach ($vins as $vin){
//           dump( (new QuoteService($vin))->minimalQuoteData());
//        }

//        $vin = 'W1N0G8EB8MV315683';
//        $data = (new QuoteService($vin))->minimalQuoteData();
//        dd((new CrawlerCore($vin))->startCrawling());
        dd(SourceChecker::isFileExist('https://cut-images.roadster.com/evox/color_640_001_png/13890/13890_cc640_001_149.png'));
    }

    public function parseXML()
    {
        $vin = 'W1K5J4HB2MN217998';
        $decodedVin = VinDecoder::decodeVin($vin);

        if (!empty($decodedVin['brand'])) {
            $brand = strtolower($decodedVin['brand']);
            $allModels = Paths::BRANDS[$brand];

            foreach ($allModels as $key => $url) {
                $url = str_replace('{year}', $decodedVin['year'], str_replace('{vin}', $vin, $url['url']));

                $result = (new CrawlerFactory(new RegExp()))->setPageUrl($url)
                                                            ->setQuery([
                                                                "msrp" => 'data-test="vdp-price-row">(.*?)</span>',
                                                            ])
                                                            ->crawl();

                dd($result);
                echo $key;
                if (!empty($result['msrp'])) {
                    dd($result);
                    break;
                }
            }
        }


        dd($decodedVin);
//        $paths = Paths::PATHS;
//
//        $newArray = [];
//        foreach ($paths as $path) {
//            preg_match('/https:\/\/www.edmunds.com\/(.*?)\/(.*?)\//', $path, $matches);
//            $newArray[$matches[1]][] = [
//                "model" => $matches[2],
//                "url"   => "https://www.edmunds.com/$matches[1]/$matches[2]/{year}/vin/{vin}/",
//            ];
//        }
//        file_put_contents('json.json',json_encode($newArray,JSON_UNESCAPED_SLASHES));
        dd();
    }

    public function vintest()
    {

        $url = "https://express.mbofbrooklyn.com/express/4JGFB4KBXMA560498?deal_type=cash&in_store=1&delivery=1";

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7) AppleWebKit/534.48.3 (KHTML, like Gecko) Version/5.1 Safari/534.48.3');

//for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);
//
//        preg_match_all('/64,975/',$resp,$marches);
//        ob_start();
//        $res= $resp.'
//        <script>
//        console.log(window.pageData.express_query.vehicle.msrp)
//
// var xmlHttp = new XMLHttpRequest();
//    xmlHttp.open( "GET", "http://metal24/testshit/" + window.pageData.express_query.vehicle.msrp, false ); // false for synchronous request
//    xmlHttp.send( null );
//
//    </script>
//        ';
//
////        $doc = new \DOMDocument();
////        $doc->loadHTML($res);
//        echo "<div style='display: none;z-index: 99999999999999999999'>$res</div>";
////        readfile('yourpage.html');
//        dd();
////        echo file_get_contents('yourpage.html');
//        $doc = new \DOMDocument();
//        libxml_use_internal_errors(true);
//        $doc->loadHTML(eval(file_get_contents('yourpage.html')));
//        $docx = new \DOMXPath($doc);
//        $titles = $docx->evaluate('//div[@class="msrp_t"]');
//        $extractedContent = [];
//        foreach ($titles as $title) {
//            $extractedContent[] = $title->textContent.PHP_EOL;
//        }
//        dd($extractedContent);

//        (new Decoder('4JGFB4KBXMA560498'))->crawl();
//        $html = htmlentities(file_get_contents("https://express.mbofbrooklyn.com/express/4JGFB4KBXMA560498"));
//        $doc = new \DOMDocument();
//        $parse = $doc->loadHTML($html);
//        $h1 = $doc->getElementsByTagName("body");
//                preg_match_all('/[0-9]{2},[0-9]{3}/', $h1->item(0)->textContent, $matches);
//
////        $body = $h1->item(0)->textContent
//
//        dd($this->crawl_page("https://express.mbofbrooklyn.com/express/4JGFB4KBXMA560498"));

//        $client = new \Goutte\Client(HttpClient::create(['timeout' => 10]));
//        $crawler = $client->request('GET', 'https://express.mbofbrooklyn.com/express/4JGFB4KBXMA560498');
//        $crawler->filter('.ExpBuildPrice > span')->each(function ($node) {
//            print $node->text()."\n";
//        });

//        $url = "https://express.mbofbrooklyn.com/express/4JGFB4KBXMA560498";
//        $html = file_get_contents($url);
//
//        $crawler = new \Symfony\Component\DomCrawler\Crawler($html);
//        $productTitle= $crawler->filter('.ExpBuildPrice')->first()->text();
//        dd($productTitle);


//        $httpClient = new \GuzzleHttp\Client();
//        $response = $httpClient->get('https://express.audiqueens.com/express/WAUD3AF26MN069224?delivery=1');
//        $htmlString = (string)$response->getBody();
////add this line to suppress any warnings
//        libxml_use_internal_errors(true);
//        $doc = new \DOMDocument();
//        $doc->loadHTML($htmlString);
//        $xpath = new \DOMXPath($doc);
//
//        $titles = $xpath->evaluate('//span[@class="ExpBuildPrice"]');
//        $extractedTitles = [];
//        foreach ($titles as $title) {
//            $extractedTitles[] = $title->textContent.PHP_EOL;
//            echo $title->textContent.PHP_EOL;
//        }

        //OK
//        $httpClient = new \GuzzleHttp\Client();
//        $response = $httpClient->get('https://www.lexusofqueens.com/new/LEXUS/2021-LEXUS-GX+460-6027659a0a0e09b1761e6022d98b79c5.htm');
//        $htmlString = (string) $response->getBody();
////add this line to suppress any warnings
//        libxml_use_internal_errors(true);
//        $doc = new \DOMDocument();
//        $doc->loadHTML($htmlString);
//        $xpath = new \DOMXPath($doc);
//
//        $titles = $xpath->evaluate('//span[@class="price-value"]');
//        $extractedTitles = [];
//        foreach ($titles as $title) {
//            $extractedTitles[] = $title->textContent.PHP_EOL;
//            echo $title->textContent.PHP_EOL;
//        }


        //VOLVO
        //https://www.dealerrater.com/classifieds/2011-Volvo-C30-ad-YV4102RLXM1820709-112285/
        $pageUrl = "https://www.dealerrater.com/classifieds/2011-Volvo-C30-ad-YV4102RLXM1820709-112285/";
        $regexps = [
            'msrp'     => '/<span class="notranslate">\$(.*?)<\/span>/',
            'image'    => '/<div class="item active" data-slide-number="0">.+?<img class="" src="(.*?)"/s',
            'model'    => '/<h1 class="h1-header line-height-125" itemprop="name">(.*?)<\/h1>/s',
            'exterior' => '/Exterior Color.*?class="td font-16 capitalize">(.*?)<\/div/s',
            'interior' => '/Interior Color.*?class="td font-16 capitalize">(.*?)<\/div/',
        ];
        $res = (new CrawlerFactory(new RegExp()))->setPageUrl($pageUrl)
                                                 ->setQuery($regexps)
                                                 ->crawl();

        dd($res);
        $httpClient = new Client();
        $response = $httpClient->get($pageUrl);
        $htmlString = strip_tags((string)$response->getBody());
        preg_match('/\$(.*?) Dealer Advertised Price/', $htmlString, $mathes);
        dd($mathes);
        dd(
            (new CrawlerFactory())->setPageUrl($pageUrl)
                                  ->getPageContent()

        );
    }

    public function regexp()
    {
        $text = file_get_contents('text.html');
        preg_match_all('/<font color="#000000">(\+7.?\(\d{3}\).?\d{3}-\d{2}-\d{2}).*?<\/font>/ms', $text, $mathes);

        $result = '';

        $array = [];
        foreach ($mathes[1] as $mathe) {
            $trim = str_replace(' ', '', $mathe);
            $checkNum = substr($trim, 3, 3);
            if ($checkNum == 495) {
                $array[] = $trim;
            }
        }
        file_put_contents('номера - городские.txt', implode("\n", array_unique($array)));

    }
}
