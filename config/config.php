<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cache Time
    |--------------------------------------------------------------------------
    |
    | Cache time for get data voucher usd
    |
    | - set zero for remove cache
    | - set null for forever
    |
    | - unit: minutes
    */

    "cache_time" => env("VOUCHER_USD_CACHE_TIME", 0),

    /*
    |--------------------------------------------------------------------------
    | API URLS
    |--------------------------------------------------------------------------
    |
    | API URLS for get data voucher usd
    |
    */

    'api_urls' => [
        'auth' => env('VOUCHER_USD_API_AUTH', 'https://cst-ids.voucherusd.com/api/v1'),
        'base' => env('VOUCHER_USD_API_BASE', 'https://api.voucherusd.com/api/v1')
    ],

    /*
    |--------------------------------------------------------------------------
    | API Parameters
    |--------------------------------------------------------------------------
    |
    | API Parameters for get data voucher usd
    |
    */

    'params' => [
        'client_id' => env('VOUCHER_USD_CLIENT_ID'),
        'client_secret' => env('VOUCHER_USD_CLIENT_SECRET')
    ],

];
