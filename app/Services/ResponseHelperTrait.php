<?php


namespace App\Services;

use GuzzleHttp\Client;

trait ResponseHelperTrait
{
    private $data = [
        'success'   => false,
        'data'      => null,
        'message'      => 'Internal Server Error'
    ];

}
