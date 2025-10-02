<x-mail-layout :banner="$banner">
    <p>{{ __('mails/generic.greeting_name', ['name' => $names]) }}</p>
    {!! __('mailer/group-manager-bought-things-for-you-notification.message', [
        'manager' => $group_manager,
        'group' => $group,
        'event' => $event_name,
    ]) !!}
    <p>{!! __('mailer/group-manager-bought-things-for-you-notification.cta', ['url' => $autoconnect]) !!}</p>
    <p>{{ __('mails/generic.closing') }}</p>
    <p>{!! $signature !!}</p>
</x-mail-layout>
