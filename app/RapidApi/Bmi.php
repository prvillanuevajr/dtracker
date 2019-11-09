<?php

namespace App\RapidApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Bmi
{
    public function get_bmi($gender, int $age, $weight, $height, $hip, $waist): array
    {
        $client = new Client();
        try {
            $bmi_api_response = $client->post('https://bmi.p.rapidapi.com/', [
                'headers' => [
                    'x-rapidapi-host' => 'bmi.p.rapidapi.com',
                    'x-rapidapi-key' => config('app.rapid_api_bmi_key'),
                    'content-type' => 'application/json',
                    'accept' => 'application/json'
                ],
                'json' => [
                    'weight' => [
                        'value' => $weight,
                        'unit' => 'kg'
                    ],
                    'height' => [
                        'value' => $height,
                        'unit' => 'cm'
                    ],
                    "sex" => strtolower($gender),
                    "age" => $age,
                    "waist" => $waist,
                    "hip" => $hip
                ]
            ]);
        } catch (ClientException $clientException) {
            return $this->get_bmi($gender, $age, $weight, $height, $hip, $waist);
        }
        return json_decode($bmi_api_response->getBody()->getContents(), true);
    }
}