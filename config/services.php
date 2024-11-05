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

    'mailgun'  => [
        'domain'   => env('MAILGUN_DOMAIN'),
        'secret'   => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme'   => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses'      => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google'   => [
        'client_id'     => '81979596025-pni8sbs5ehhr6mf8t2n5adsr9oekiba8.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect'      => 'http://localhost:8000/auth/google/callback',
    ],

    'facebook' => [
        'client_id'     => '994882865175556',
        'client_secret' => 'e9192e19381802eacb5c27cc43a75e5a',
        'redirect'      => 'http://localhost:8000/auth/facebook/callback',
    ],
];
