<x-mail-layout :banner="$banner">
    {!! __('ui.send_event_group_confirmation.content', [], $locale) !!}<br/>
    <a href="{{ $link }}"
       target="_blank">{{__('ui.send_event_group_confirmation.link_text', $locale)}}</a><br/>
    <br/>
    {{ __('mails/generic.closing', [], $locale) }}

</x-mail-layout>
