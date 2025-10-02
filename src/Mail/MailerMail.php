<?php

declare(strict_types=1);

namespace MetaFramework\Mailer\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use MetaFramework\Mailer\Contracts\MailerInterface;

class MailerMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(public MailerInterface $mailed) {}

    public function build(): static
    {
        $sendable = $this
            ->from($this->mailed->from())
            ->to($this->mailed->email())
            ->subject($this->mailed->subject())
            ->view($this->mailed->view())
            ->with(
                array_merge([
                    'mailed' => $this->mailed,
                ], $this->mailed->getViewData()),
            );

        if (method_exists($this->mailed, 'attachments')) {
            foreach ($this->mailed->attachments() as $attachment) {
                if (! is_array($attachment)) {
                    continue;
                }

                $keys = array_keys($attachment);
                if (count(array_intersect(['as', 'file', 'mime'], $keys)) !== 3) {
                    continue;
                }

                if (($attachment['type'] ?? null) === 'binary') {
                    $sendable->attachData($attachment['file'], $attachment['as']);
                    continue;
                }

                $sendable->attach($attachment['file'], [
                    'as'   => $attachment['as'],
                    'mime' => $attachment['mime'],
                ]);
            }
        }

        return $sendable;
    }
}
