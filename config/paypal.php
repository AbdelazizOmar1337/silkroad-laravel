<?php
/**
 * PayPal Setting & API Credentials
 */
return [
    'mode' => env('PAYPAL_MODE', 'sandbox'),
    'sandbox' => [
        'clientId' => env('PAYPAL_SANDBOX_API_CLIENT_ID', ''),
        'secret' => env('PAYPAL_SANDBOX_API_SECRET', ''),
    ],
    'live' => [
        'clientId' => env('PAYPAL_LIVE_API_CLIENT_ID', ''),
        'secret' => env('PAYPAL_LIVE_API_SECRET', ''),
    ],
];
