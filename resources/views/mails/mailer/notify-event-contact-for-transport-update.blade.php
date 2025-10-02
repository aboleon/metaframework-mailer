<x-mail-layout :banner="$banner">
    <p>{{ __('mails/generic.greeting_name', ['name' => $names], $locale) }}</p>
    <p>{!! __('mailer/notify-event-contact-for-transport-update.text', ['autoconnect' => $autoconnect], $locale) !!}</p>
    <p>{{ __('mails/generic.closing') }}</p>
    <p>{{ $signature }}</p>
</x-mail-layout>
