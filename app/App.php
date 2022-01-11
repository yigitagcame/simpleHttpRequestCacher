<?php

namespace App;

use App\Services\CacheInterface as CacheInterface;
use App\Services\HttpService as HttpService;

class App {

    public $cache;

    public function __construct(CacheInterface $cache,HttpService $apiRequest){
        $this->cache = $cache;
        $this->request = $apiRequest;
    }

    public function run(){

        $apiAuthKey = '';

        $api = [
            'baseUrl' => '',
            'path' => ''
        ];

        $requestBody = [
          "recipient" => [
              "address1" => "11025 Westlake Dr",
              "city" => "Charlotte",
              "country_code"=>  "US",
              "state_code"=>  "NC",
              "zip"=>  28273
          ],
          "items" => [
              [
                  "quantity" => 2,
                  "variant_id" => 7679
              ]
          ]
      ];

        $cacheKey = md5($api['baseUrl'].$api['path'].json_encode($requestBody));

        [$cachedResponse,$index] = $this->cache->get($cacheKey); 

        if(is_array($cachedResponse) && !empty($cachedResponse) && $cachedResponse['expiry_date'] > time()){
            echo json_encode($cachedResponse['value']);
            return true;
        }

        $response = $this->request->post(
            $api['baseUrl'],
            $api['path'],
            $requestBody,
            $apiAuthKey
        );

        if(!$response){
            echo 'Api call is unsuccessful!';
            return false;
        }

        $responseArray = json_decode($response);

        if($responseArray->code == 200){
            $this->cache->set($cacheKey,$responseArray->result,5);
        }

        echo json_encode($responseArray->result);


    }


}