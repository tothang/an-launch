<?php

use App\Http\Controllers\Admin\Auth\AdfsLoginController;
use Drp\AdfsSocialiteProvider\Http\Controllers\RedirectToProvider;

return [
    'login' => [
        'guard' => 'admin',
        'prefix' => 'admin',
        'url' => 'adfs',
        'callback_url' => 'callback',
        'middleware' => [
            'web',
        ],
        'route_name' => 'adfs.login',
        'callback_name' => 'adfs.callback',
    ],

    'redirect_controller' => RedirectToProvider::class,
    'handle_controller' => AdfsLoginController::class,

    'auth' => [
        'client_id' => env('ADFS_CLIENT_ID'),
        'client_secret' => env('ADFS_CLIENT_SECRET', null),
        'authorization_url' => env('ADFS_AUTH_URL'),
        'token_url' => env('ADFS_TOKEN_URL'),
        'claims' => [
            'email',
            'given_name',
            'family_name',
        ],
        'user_model' => \App\Admin::class,
    ],
];
