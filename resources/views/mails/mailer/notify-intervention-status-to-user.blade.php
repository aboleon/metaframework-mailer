<x-mail-layout :banner="$banner">

    <p>{{ __('mails/generic.greeting_name', ['name' => $names],$locale) }}</p>
    <p>{!! __('mails/front/intervention-status.to_user.'.$status, ['intervention' => $intervention], $locale) !!}</p>
    <p>{{ __('mails/generic.closing',[],$locale) }}</p>
    <p>{!! $signature !!}</p>

</x-mail-layout>

