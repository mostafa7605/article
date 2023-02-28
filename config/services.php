<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => 'https://newrwrite.msol.dev/auth/login/google/callback',
    ],
    'facebook' => [
        'client_id' => '547528369716397', //Facebook API
        'client_secret' => 'e2c8affbdc65a4b03d0d9a7b3dc231e5', //Facebook Secret
        'redirect' => 'https://newrwrite.msol.dev/socialsync/facebook/callback',

    ],
    'instagram' => [
        'client_id' => '692850842011703', //instagram API
        'client_secret' => '7f95225ccb632a1b3fe2f99b4341b04e', //instagram Secret
        'redirect' => 'https://newrwrite.msol.dev/socialsync/instagram/callback'
    ],


    'twitter' => [
        'client_id' => 'CVuqDJ1LWxayjfPrrmSbk7flv', //twittedr API
        'client_secret' => 'on9XlRFAbC6XZCw8T96Aqnq3c9cI22SEygQJeLDkQYlNQ9Bw9g', //t'witter Secret
        'redirect' => 'https://newrwrite.msol.dev/socialsync/twitter/callback',
    ],

];
