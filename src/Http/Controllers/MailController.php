<?php

declare(strict_types=1);

namespace MetaFramework\Mail\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use MetaFramework\Mail\Contracts\MailerInterface;
use MetaFramework\Support\Traits\Ajax;
use MetaFramework\Support\Traits\Responses;
use ReflectionClass;
use Throwable;

class MailController extends Controller
{
    use Ajax;
    use Responses;

    protected array $values = [];

    public function setValue(string $key, mixed $value): self
    {
        $this->values[$key] = $value;

        return $this;
    }

    public function setValues(array $values): self
    {
        foreach ($values as $key => $value) {
            $this->setValue($key, $value);
        }

        return $this;
    }

    public function getValue(string $key): mixed
    {
        return $this->values[$key] ?? null;
    }

    public function distribute(string $type, object|string $identifier): self
    {
        $mailer = $this->resolveMailerClass($type);

        if (! $mailer) {
            return $this;
        }

        if (! in_array(MailerInterface::class, class_implements($mailer))) {
            $this->responseError($mailer.' does not implement '.MailerInterface::class);

            return $this;
        }

        if (! (new ReflectionClass($mailer))->isInstantiable()) {
            $this->responseError($mailer.' is not an instantiable mailer');

            return $this;
        }

        $instance = new $mailer();

        if ($this->isAjaxMode()) {
            $instance->enableAjaxMode();
        }

        if ($this->isInConsoleMode()) {
            $instance->consoleLog();
        }

        if (is_object($identifier)) {
            $instance->setModel($identifier);
        }

        if (is_string($identifier)) {
            $instance->setIdentifier($identifier);
        }

        $instance->setRequestData($this->values);

        if (method_exists($instance, 'setData')) {
            $instance->setData();
            if ($instance->hasErrors()) {
                $this->pushMessages($instance);

                return $this;
            }
        }

        $sent = $instance->send();
        $messages = $instance->fetchResponse()[$instance->getMessageKey()] ?? [];

        $this->pushMessages($instance);

        if (! $sent) {
            return $this;
        }

        if ($messages === []) {
            $this->responseSuccess("L'email a été envoyé.");
        }

        return $this;
    }

    public function render(string $type, string $identifier): RedirectResponse
    {
        $this->distribute($type, $identifier);

        return $this->sendResponse();
    }

    private function resolveMailerClass(string $type): ?string
    {
        $candidates = [$type];

        $defaultNamespace = rtrim(config('metaframework.mailer.namespaces.default', 'App\\Mailer'), '\\');
        $candidates[] = $defaultNamespace.'\\'.ucfirst($type);

        foreach ($candidates as $candidate) {
            try {
                new ReflectionClass($candidate);

                return $candidate;
            } catch (Throwable) {
                continue;
            }
        }

        $this->responseError('Mailer inconnu');

        return null;
    }
}
