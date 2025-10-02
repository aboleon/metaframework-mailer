<x-mail-layout :banner="$banner">
    <p>{{ __('mails/generic.greeting_name', ['name' => $names], $locale) }}</p>
    <p>{!! __('mailer/notify-password-change-by-admin.the_password', ['password' => $password], $locale) !!}</p>
    <p>{!! __('mailer/notify-password-change-by-admin.the_link', ['autoconnect' => $autoconnect], $locale) !!}</p>
    <p>{!! __('mailer/notify-password-change-by-admin.final_words', [], $locale) !!}</p>
    <p>{{ __('mails/generic.closing', [], $locale) }}</p>
    <p>{!! $signature !!}</p>
</x-mail-layout>
