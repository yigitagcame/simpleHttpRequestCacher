<?php

namespace App\Services;

use GuzzleHttp\Client;

class HttpService{

    public function post(string $baseurl,string $path, array $body, $apiKey = null) : mixed{

        $client = new Client(['base_uri' => $baseurl]);

        $headers = [
            'content-type' => 'application/json',
            'Accept' => 'application/json'
        ];

        if($apiKey){
            $headers['Authorization'] = ['Basic '.base64_encode($apiKey)];
        }

        $response = $client->request('POST', $path, [
            'headers'  => $headers,
            'json' => $body,
        ]);

        if($response->getStatusCode()){
            return $response->getBody();
        }

        return false;

    }
}