<?php

use Luchavez\PassportPgtClient\Http\Controllers\DefaultAuthController;

return [
    'passport_server' => [
        'url' => env('PASSPORT_URL'),
        'password_grant_client' => [
            'id' => env('PASSPORT_PASSWORD_GRANT_CLIENT_ID'),
            'secret' => env('PASSPORT_PASSWORD_GRANT_CLIENT_SECRET'),
        ],
        'routes' => [
            'register' => [
                'uri' => 'api/oauth/register',
                'http_method' => 'post',
            ],
            'login' => [
                'uri' => 'oauth/token',
                'http_method' => 'post',
            ],
            'logout' => [
                'uri' => 'api/oauth/logout',
                'http_method' => 'post',
            ],
            'refresh-token' => [
                'uri' => 'oauth/token',
                'http_method' => 'post',
            ],
            'me' => [
                'uri' => 'api/oauth/me',
                'http_method' => 'get',
            ],
        ],
    ],
    'routes' => [
        'register' => [
            'uri' => 'register',
            'action' => [DefaultAuthController::class, 'register'],
            'http_method' => 'post',
        ],
        'login' => [
            'uri' => 'login',
            'action' => [DefaultAuthController::class, 'login'],
            'http_method' => 'post',
        ],
        'logout' => [
            'uri' => 'logout',
            'action' => [DefaultAuthController::class, 'logout'],
            'http_method' => 'post',
        ],
        'refresh-token' => [
            'uri' => 'refresh-token',
            'action' => [DefaultAuthController::class, 'refreshToken'],
            'http_method' => 'post',
        ],
        'me' => [
            'uri' => 'me',
            'action' => [DefaultAuthController::class, 'me'],
            'http_method' => 'get',
        ],
    ],
];
