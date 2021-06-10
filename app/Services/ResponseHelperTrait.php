<?php


namespace App\Services;

trait ResponseHelperTrait
{
    private $data = [
        'success'   => false,
        'data'      => null,
        'message'      => 'Internal Server Error'
    ];

}
