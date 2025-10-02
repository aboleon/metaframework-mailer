<x-mail-layout :banner="$banner">
    {!! __('front/groups.connect_to_attached_user', ['event' => $event_name, 'link' => $autoconnect, 'user' => $account]) !!}
</x-mail-layout>
