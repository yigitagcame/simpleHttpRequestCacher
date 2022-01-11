<?php

use PHPUnit\Framework\TestCase;
use App\Services\HttpService;

class HttpServiceTest extends TestCase{

    /** @test */

    public function a_post_request_can_be_sent_succefully(){

        $http = new HttpService();

        $apiAuthKey = '77qn9aax-qrrm-idki:lnh0-fm2nhmp0yca7';

        $api = [
            'baseUrl' => 'https://api.printful.com',
            'path' => '/shipping/rates'
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

        $response = $http->post(
            $api['baseUrl'],
            $api['path'],
            $requestBody,
            $apiAuthKey
        );

        $this->assertNotEquals(false,$response);


    }

}