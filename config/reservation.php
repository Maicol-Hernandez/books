<?php

return [
    'cookie' => [
        'name' => env('RESERVATION_COOKIE_NAME', 'reservation_cookie'),
        'expiration' => 7 * 24 * 60, // one week
    ]
];
