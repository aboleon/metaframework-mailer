<?php

return [
    'namespaces' => [
        'default' => 'App\\Mailer',
    ],
    'views' => [
        'prefix' => 'mails.mailer',
    ],
    'translations' => [
        'success' => 'mailer.success',
        'failure' => 'mailer.failure',
    ],
    'routes' => [
        'enabled' => false,
        'uri' => 'mail/{type}/{identifier}',
        'name' => 'mailer',
        'middleware' => ['web'],
    ],
];
