<?php

declare(strict_types=1);

namespace MetaFramework\Mail\Contracts;

interface MailerInterface
{
    public function setModel(object $model): self;

    public function setIdentifier(string $identifier): self;

    public function send(): bool;

    public function email(): string|array;

    public function subject(): string;

    public function view(): string;

    public function setRequestData(array $values): void;

    public function getRequestData(): mixed;

    public function successMessage(): string;

    public function failureMessage(): string;
}
