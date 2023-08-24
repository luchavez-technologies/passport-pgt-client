<?php

use Luchavez\PassportPgtClient\Http\Controllers\DefaultAuthController;

return [
    'passport_url' => env('PPC_PASSPORT_URL', config('app.url')),
    'password_grant_client' => [
        'id' => env('PPC_PGC_ID'),
        'secret' => env('PPC_PGC_SECRET'),
    ],
    'auth_controller' => DefaultAuthController::class,
];
