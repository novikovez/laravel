<?php
    return [
    'paypal' => [
        'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
        'app_id' => 'APP-80W284485P519543T',
        'mode' => env('PAYPAL_MODE', 'sandbox'),
    ],
];


