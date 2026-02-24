<?php

declare(strict_types=1);

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
    'from' => [
        'address' => null,
        'name' => null,
        'translation_key' => 'mfw.mailer.from_name',
        'strict_locale_translation' => true,
    ],
    'text' => [
        'footer_view' => null,
        'footer_separator' => null,
    ],
    'routes' => [
        'enabled' => false,
        'uri' => 'mail/{type}/{identifier}',
        'name' => 'mailer',
        'middleware' => ['web'],
    ],
];
