<?php

declare(strict_types=1);

namespace MetaFramework\Mailer\Mailer;

use Illuminate\Support\Facades\Mail;
use MetaFramework\Mailer\Contracts\MailerInterface;
use MetaFramework\Mailer\Mail\MailerMail;
use MetaFramework\Support\Traits\Responses;
use Throwable;

use function __;

abstract class MailerAbstract implements MailerInterface
{
    use Responses;

    protected ?object $model = null;
    protected ?string $identifier = null;
    private array $view_data = [];
    private array $request_data = [];

    public function setModel(object $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function send(): bool
    {
        try {
            Mail::send(new MailerMail($this));
            $this->responseSuccess($this->successMessage());

            if (method_exists($this, 'whenSent')) {
                $this->whenSent();
            }

            return true;
        } catch (Throwable $throwable) {
            $this->responseException(
                $throwable,
                $this->failureMessage(),
            );

            return false;
        }
    }

    public function from(): string|array
    {
        return [
            'email' => config('mail.from.address'),
            'name' => config('mail.from.name', config('app.name')),
        ];
    }

    public function print(string $key): string
    {
        return $this->view_data[$key] ?? '';
    }

    public function setViewData(string $key, mixed $value): void
    {
        $this->view_data[$key] = $value;
    }

    public function getViewData(): array
    {
        return $this->view_data;
    }

    public function setRequestData(array $values): void
    {
        $this->request_data = $values;
    }

    public function getRequestData(?string $key = null): mixed
    {
        return $key ? ($this->request_data[$key] ?? null) : $this->request_data;
    }

    public function successMessage(): string
    {
        return __(config('mfw.mailer.translations.success', 'mailer.success'));
    }

    public function failureMessage(): string
    {
        return __(config('mfw.mailer.translations.failure', 'mailer.failure'));
    }
}
