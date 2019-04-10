<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enabled auth types & services: 'social', 'two_factor'
    |--------------------------------------------------------------------------
    */
    'enabled' => [
        // 'social', 'two_factor', 'email_verification'
    ],

    /*
    |--------------------------------------------------------------------------
    | Socialite related parameters
    |--------------------------------------------------------------------------
    */
    'socialite' => [

        /*
        |--------------------------------------------------------------------------
        | Available socialite services
        |--------------------------------------------------------------------------
        */
        'services' => [
            'github' => [
                'name' => 'GitHub'
            ]
        ],

        /*
        |--------------------------------------------------------------------------
        | Services credentials
        |--------------------------------------------------------------------------
        */
        'github' => [
            'client_id' => env('GITHUB_CLIENT_ID'),
            'client_secret' => env('GITHUB_CLIENT_SECRET'),
            'redirect' => env('GITHUB_REDIRECT_URL'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Two factor authentication parameters
    |--------------------------------------------------------------------------
    */
    'two_factor' => [

        'authy' => [
            'secret' => env('AUTHY_SECRET')
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Redirects
    |--------------------------------------------------------------------------
    */
    'redirects' => [
        'login' => '/dashboard',
        'register' => '/dashboard',
        'reset_password' => '/',
        'social_login' => '/dashboard',
        'twofactor_login' => '/dashboard',
        'email_verification' => '/dashboard',
        'forgot_password' => '/password/reset',
        'twofactor' => '/',
    ],

];
