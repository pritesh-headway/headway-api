<?php

namespace App\Services;

class CurlApiService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.api.base_url'); // Define in config/services.php
        $this->apiKey = config('services.api.api_key');   // Define in config/services.php
    }

    public function postRequest($endpoint, $data)
    {
        $url = $this->baseUrl . $endpoint . '&';
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url . http_build_query($data),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_FOLLOWLOCATION => TRUE,
            CURLOPT_VERBOSE => TRUE,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded',  // Set the content type
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return ['error' => $err];
        }
        return $response;
    }
}
