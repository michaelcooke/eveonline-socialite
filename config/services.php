<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Eve Online ESI Application Configuration
    |--------------------------------------------------------------------------
    |
    | This configuration loads your ESI application client ID, secret key,
    | redirect URI, and datasource from your environment configuration
    | file. This allows you to switch ESI configuration seamlessly
    | in development and production.
    |
    */

    'eveonline' => [
        'client_id'     => env('EVEONLINE_KEY'),
        'client_secret' => env('EVEONLINE_SECRET'),
        'redirect'      => env('EVEONLINE_REDIRECT'),  
        'datasource'    => env('EVEONLINE_DATASOURCE', 'tranquility'),
    ],

];
