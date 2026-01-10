# MetaFramework Mailer

Convenience mailer utilities for Laravel apps. MetaFramework is a collection of small Laravel
packages; this one provides a simple base class and wiring so you can define mailer classes, fill
view data, and send messages with minimal boilerplate.
It includes:
- a `MailerAbstract` base class
- a `MailerMail` Mailable wrapper
- a generator command for mailer classes and Blade views
- an optional HTTP route for dispatching mailers
- localized success/failure messages

## Requirements
- PHP 8.3+
- Illuminate 12.x components (mail, support, routing, console, filesystem, translation)

## Installation
Install the package with Composer and rely on Laravel package auto-discovery:

```bash
composer require aboleon/metaframework-mailer
```

## Configuration
Publish the config if you want to override defaults:

```bash
php artisan vendor:publish --tag=mfw-mailer-config
```

Key settings in `config/mfw/mailer.php`:
- `namespaces.default`: base namespace for generated mailers (default `App\Mailer`)
- `views.prefix`: default view prefix for generated mailers (default `mails.mailer`)
- `routes.enabled`: enable the HTTP route (default `false`)

## Generate a mailer
Create a mailer class and Blade view:

```bash
php artisan app:make-mailer Admin/Notification
```

This generates:
- `app/Mailer/Admin/Notification.php`
- `resources/views/mails/mailer/admin/notification.blade.php`

You can override the view name and add translation stubs:

```bash
php artisan app:make-mailer User/Welcome --view=mails.user.welcome --translations
```

## Define a mailer
Example mailer implementation:

```php
<?php

namespace App\Mailer;

use MetaFramework\Mailer\Mailer\MailerAbstract;

final class AccountStatusMailer extends MailerAbstract
{
    public function setData(): self
    {
        $this->setViewData('user', $this->model);
        $this->setViewData('status', $this->getRequestData('status'));

        return $this;
    }

    public function email(): string|array
    {
        return $this->model->email;
    }

    public function subject(): string
    {
        return 'Your account status changed';
    }

    public function view(): string
    {
        return 'mails.mailer.account-status';
    }
}
```

### Blade view example
Use the injected `$mailed` object or custom view data:

```blade
<x-mail-layout>
    <p>Hello {{ $mailed->print('user')->name }},</p>
    <p>Status: {{ $mailed->print('status') }}</p>
</x-mail-layout>
```

## Send a mailer
Send directly from application code:

```php
use App\Mailer\AccountStatusMailer;

$mailer = new AccountStatusMailer();
$mailer->setModel($user)
    ->setRequestData([
        'status' => 'approved',
    ])
    ->setData()
    ->send();
```

## Optional HTTP route dispatch
Enable the route in config:

```php
// config/mfw/mailer.php
'routes' => [
    'enabled' => true,
    'uri' => 'mail/{type}/{identifier}',
    'name' => 'mailer',
    'middleware' => ['web'],
],
```

Then call:

```
POST /mail/welcome/123
```

`MailController` resolves the mailer class by:
- `type` as a fully qualified class name, or
- `namespaces.default` + `ucfirst(type)`

## Attachments
Define an `attachments()` method on your mailer to attach files:

```php
public function attachments(): array
{
    return [
        [
            'file' => storage_path('reports/daily.pdf'),
            'as' => 'daily-report.pdf',
            'mime' => 'application/pdf',
        ],
        [
            'type' => 'binary',
            'file' => $rawPdfData,
            'as' => 'inline.pdf',
            'mime' => 'application/pdf',
        ],
    ];
}
```

## Translations
Success and failure messages are configurable:

```php
'translations' => [
    'success' => 'mailer.success',
    'failure' => 'mailer.failure',
],
```

Translation files ship in `resources/lang/en/mailer.php` and `resources/lang/fr/mailer.php`.

## Publishing views and translations
```bash
php artisan vendor:publish --tag=mfw-mailer-views
php artisan vendor:publish --tag=mfw-mailer-lang
```
