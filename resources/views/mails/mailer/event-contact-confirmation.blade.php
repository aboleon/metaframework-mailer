<x-mail-layout :banner="$banner">
    {!! __('ui.send_event_contact_confirmation.content', [], $locale) !!}<br/>
    <a href="{{ $mailed->data['link']}}"
       target="_blank">{{__('ui.send_event_contact_confirmation.link_text', $locale) }}</a><br/>
    <br/>
    {{__('mails/generic.closing', [], $locale)}}
    {{ $signature }}
</x-mail-layout>
