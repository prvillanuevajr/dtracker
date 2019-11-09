<?php

namespace App\ApiMedicTools;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class GetDiagnosis
{
    public function getDiagnosis($symptoms, $year_of_birth, $gender)
    {
        $client = new Client();
        try {
            $response = $client->get('https://healthservice.priaid.ch/diagnosis', [
                'query' => [
                    'token' => cache()->get('api_medic_token'),
                    'symptoms' => json_encode($symptoms),
                    'year_of_birth' => $year_of_birth,
                    'gender' => $gender == 'M' ? 'male' : 'female',
                    'language' => 'en-gb'
                ]
            ]);
        } catch (ClientException $clientException) {
            (new GetAuthenticationToken())->getToken();
            return $this->getDiagnosis($symptoms, $year_of_birth, $gender);
        }
        return json_decode($response->getBody()->getContents(), true);
    }
}