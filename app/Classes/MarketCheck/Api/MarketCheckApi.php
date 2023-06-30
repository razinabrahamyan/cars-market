<?php

namespace App\Classes\MarketCheck\Api;

class MarketCheckApi
{
    const KEY = 'vnCVyOKk3p22CTq7Yhqv5x6t9YmtfXLA';
    const SECRET_KEY = 'shINoOz0diJ9DE2y';
    const BASE_URL = 'http://api.marketcheck.com/v2/';
    const HOST = 'marketcheck-prod.apigee.net';

    protected $vin;
    protected $hashedVIN;

    /**
     * @param $vin
     * @return $this
     */
    public function setVin($vin) : MarketCheckApi
    {
        $this->vin = $vin;
        return $this;
    }

    /**
     * You will get an error response in the following scenario:
     * If you specify page param greater than num_found
     * If VIN could not be decoded for make
     * If VIN is not looked up ever by us i.e. it is not in our database
     * URI Example: http://api.marketcheck.com/v2/history/car/4JGFB4KB2MA574136?api_key={{apiKey}}&page=1
     */
    public function getCarHistory()
    {
        $request = $this->get('history/car/'.$this->vin, [
            "api_key" => self::KEY,
            "page"    => 1,
        ]);

        if (!empty($request) && !empty($request[0])) {
            $historyFirstElement = $request[0];
            $this->hashedVIN = $historyFirstElement['id'];
        }

        return $request;
    }

    /**
     * Once a Search is performed the next logical step would be to obtain more details about the listing
     * like the car photos, installed options list, features, seller comments etc.
     * These could be obtained using the Listing API by passing in a unique Marketcheck Listing ID to the API that you
     * obtain from the Search API responses.
     */
    public function getCarListing()
    {
        $request = [];
        if (!empty($this->hashedVIN)) {
            $request = $this->get('listing/car/'.$this->hashedVIN, [
                "api_key" => self::KEY,
                "page"    => $this->hashedVIN,
            ]);
        }

        return $request;
    }

    /**
     * Basic GET Request
     * @param string $method
     * @param array $params
     * @return mixed
     */
    public function get(string $method, array $params)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => self::BASE_URL.$method."?".http_build_query($params),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => '',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => array(
                "Host: ".self::HOST,
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
