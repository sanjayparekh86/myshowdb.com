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
        'scheme' => 'https',
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
        'client_id' => '196736252307-k115pro0h7cufapl5ai24c8oe5ir9703.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://127.0.0.1:8000/auth/google/callback'
    ],

    'movie_api' => [
        'movie_key' => '51101056b51c9e0344dab7b902a24377',
        'token' => 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1MTEwMTA1NmI1MWM5ZTAzNDRkYWI3YjkwMmEyNDM3NyIsInN1YiI6IjY1OTJiODk1ZjVmMWM1Nzc2NzAxMDgwNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6euLfctgKQPiOdWOgl28wM4GOTiD0TWTUPFYltpsehg'
    ],

    'facebook' => [
        'client_id' => '656748396673665',
        'client_secret' => 'd0f6ebb2868ca23f9b226a033f75e9fd',
        'redirect' => 'http://localhost:8000/auth/facebook/callback'
    ],

];
