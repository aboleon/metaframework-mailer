<?php

declare(strict_types=1);

namespace MetaFramework\Mailer;

use Illuminate\Support\ServiceProvider;
use MetaFramework\Mailer\Console\Commands\MakeMailer;

class MailerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/mailer.php', 'mfw.mailer');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mfw-mailer');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'mfw-mailer');

        if (config('mfw.mailer.routes.enabled', false)) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }

        if ($this->app->runningInConsole()) {
            $this->commands([MakeMailer::class]);

            $this->publishes([
                __DIR__.'/../config/mailer.php' => config_path('mfw/mailer.php'),
            ], 'mfw-mailer-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/mfw-mailer'),
            ], 'mfw-mailer-views');

            $this->publishes([
                __DIR__.'/../resources/lang' => lang_path('vendor/mfw-mailer'),
            ], 'mfw-mailer-lang');
        }
    }
}
