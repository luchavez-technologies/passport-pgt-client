<?php

use Illuminate\Support\Facades\Route;

collect(config('passport-pgt-client.routes'))->each(function (array $arr, string $key) {
    ['uri' => $uri, 'action' => $action, 'http_method' => $method] = $arr;
    Route::$method($uri, $action)->name("passport-pgt-client.$key");
});
