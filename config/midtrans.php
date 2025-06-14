<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION'),
    'is_sandbox' => env('MIDTRANS_IS_SANDBOX'),
    'is_3ds' => env('MIDTRANS_IS_3DS'),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED'),
];