<?php

use Symfony\Component\HttpFoundation\Request;

return [

    /*
    |--------------------------------------------------------------------------
    | Trusted Proxies
    |--------------------------------------------------------------------------
    |
    | Set IP proxy yang dipercaya, atau gunakan '*' untuk semua proxy
    |
    */
    'proxies' => '*',

    /*
    |--------------------------------------------------------------------------
    | Headers Yang Digunakan
    |--------------------------------------------------------------------------
    |
    | Header dari proxy yang harus dipercaya Laravel.
    |
    */
    'headers' => Request::HEADER_X_FORWARDED_TRAEFIK,

];
