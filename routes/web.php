<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use MetaFramework\Mailer\Http\Controllers\MailController;

Route::middleware(config('mfw.mailer.routes.middleware', ['web']))
    ->name(config('mfw.mailer.routes.name', 'mailer'))
    ->any(
        config('mfw.mailer.routes.uri', 'mail/{type}/{identifier}'),
        [MailController::class, 'distribute']
    );
