<?php

namespace App\ApiMedicTools;

class GetAuthenticationToken
{
    public function getToken()
    {
        $username = config('app.APIMEDIC_USERNAME');
        $password = config('app.APIMEDIC_PASSWORD');
        $uri = 'https://authservice.priaid.ch/login';
        $hash = base64_encode(hash_hmac('md5', $uri, $password, true));
        $client = new \GuzzleHttp\Client();
        $response = $client->post($uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . $username . ':' . $hash
            ]
        ]);
        $response = json_decode($response->getBody()->getContents(), true);
        cache()->put('api_medic_token', $response['Token']);
        return cache()->get('api_medic_token');
    }
}