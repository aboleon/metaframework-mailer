<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use MetaFramework\Mail\Http\Controllers\MailController;

Route::middleware(config('metaframework.mailer.routes.middleware', ['web']))
    ->name(config('metaframework.mailer.routes.name', 'mailer'))
    ->any(
        config('metaframework.mailer.routes.uri', 'mail/{type}/{identifier}')
    , [MailController::class, 'distribute']);
