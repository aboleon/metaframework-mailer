<x-mail-layout :banner="$banner">

    <p>{{ __('mails/generic.greeting_name', ['name' => $names],$locale) }}</p>
    <p>{!! __('mails/front/notify-participant-self-response-invitation-sellable.body_'.$status, ['sellable' => $sellable], $locale) !!}</p>
    <p>{{ __('mails/generic.closing',[],$locale) }}</p>
    <p>{!! $signature !!}</p>

</x-mail-layout>

