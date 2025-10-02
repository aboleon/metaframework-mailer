<x-mail-layout :banner="$banner">
    <p>{{ __('mails/generic.greeting_name', ['name' => $names]) }}</p>
    <p>{!! __('mailer/back-office-order-confirmation.text', ['event' => $event_name, 'autoconnect' => $autoconnect]) !!}</p>
    <p>{{ __('mails/generic.closing') }}</p>
    <p>{{ $signature }}</p>
</x-mail-layout>
