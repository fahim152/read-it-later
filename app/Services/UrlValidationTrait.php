<?php

namespace App\Services;

use GuzzleHttp\Client;

trait UrlValidationTrait
{
    public static function validateUrl($url)
    {

        $client = new Client();
        try {
            $req = $client->head($url);
            if(! $req->getStatusCode() == 200 ) {
                return ['success' => false, 'error_code' => 'NGZSM7', 'message' => 'Url should return HTTP response 200'];
            }

            return ['success' => true];
        } catch (\Exception $e) {

            return  ['success' => false, 'error_code' => '7SVLGO', 'message' => 'Invalid Url Parameter'];
        }
    }
}
