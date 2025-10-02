<x-mail-layout :banner="$banner">
    <p>{{ __('mails/generic.greeting_name', ['name' => $names], $locale) }}</p>
    {!! __('mails/front/notify-event-contact-for-uploaded-document.text', ['autoconnect' => $autoconnect]) !!}
    <p>{{ __('mails/generic.closing') }}</p>
    <p>{{ $signature }}</p>
</x-mail-layout>
