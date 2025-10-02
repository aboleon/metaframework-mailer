<x-mail-layout :banner="$banner">
    <p>{{ __('mails/generic.greeting_name', ['name' => $names], $locale) }}</p>
    <p>{!! __('mails/front/confirm-reception-group-manager-demand.text', [], $locale) !!}</p>
    <p>{{ __('mails/generic.closing', [], $locale) }}</p>
    <p>{!! $signature !!}</p>
</x-mail-layout>
