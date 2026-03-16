<?php

return [
    'api_path' => 'api/v1',

    'api_domain' => null,

    'export_path' => 'docs/api.json',

    'info' => [
        'version' => env('API_VERSION', '1.0.0'),
        'description' => 'Customer mobile application API for AFAQ. Includes authentication, project discovery, bookings, inquiries, notifications, content pages, public settings, and push device token management.',
    ],

    'ui' => [
        'title' => 'AFAQ Customer API Docs',
        'theme' => 'light',
        'hide_try_it' => false,
        'hide_schemas' => false,
        'logo' => '',
        'try_it_credentials_policy' => 'include',
        'layout' => 'responsive',
    ],

    'servers' => null,

    'enum_cases_description_strategy' => 'description',
    'enum_cases_names_strategy' => false,
    'flatten_deep_query_parameters' => true,

    'middleware' => [
        'web',
        'Dedoc\\Scramble\\Http\\Middleware\\RestrictedDocsAccess',
    ],

    'extensions' => [],
];
