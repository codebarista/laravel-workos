<?php

return [
    'routes' => [
        'authenticate' => env('LARAVEL_WORKOS_ROUTES_AUTHENTICATE', default: 'authenticate'),
        'logout' => env('LARAVEL_WORKOS_ROUTES_LOGOUT', default: 'logout'),
        'login' => env('LARAVEL_WORKOS_ROUTES_LOGIN', default: 'login'),
    ],
    'redirect' => [
        'to_route_name' => env('LARAVEL_WORKOS_REDIRECT_TO_ROUTE_NAME', default: 'dashboard'),
    ],
    'middleware' => [
        'web',
    ],
];
