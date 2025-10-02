<x-front-mail-layout :banner="$banner">
    <div class="p-20">
        <p>{{ __('mails/generic.greeting_name', ['name' => $managerName], $locale) }}</p>

        <p>{{ __('mails/mailer/group-attribution.intro_'.$type, ['event' => $eventName], $locale) }}</p>

        @foreach($summary as $item)
            @if($item['type'] === \App\Enum\OrderCartType::SERVICE->value)
                <h4 class="mt-4">{{ __('mails/mailer/group-attribution.service_title', ['label' => $item['label']], $locale) }}</h4>
            @else
                <h4 class="mt-4">
                    {{ __('mails/mailer/group-attribution.accommodation_title', [
                        'room' => $item['label']['room'] ?? '',
                        'hotel' => $item['label']['hotel'] ?? '',
                    ], $locale) }}
                </h4>
                @if(!empty($item['label']['room_category']))
                    <p>{{ __('mails/mailer/group-attribution.room_category', ['label' => $item['label']['room_category']], $locale) }}</p>
                @endif
            @endif

           <ul>
               @foreach($item['entries'] as $entry)
                    @php
                        $lineKey = $item['type'] === 'accommodation' && !empty($entry['date'])
                            ? 'entry_line_accommodation'
                            : 'entry_line';
                    @endphp
                    <li>
                        {{ __('mails/mailer/group-attribution.'.$lineKey, [
                            'member' => $entry['member'],
                            'quantity' => $entry['quantity'],
                            'date' => $entry['date'] ?? '',
                        ], $locale) }}
                    </li>
                @endforeach
            </ul>
        @endforeach

        <p>{!! __('mails/mailer/group-attribution.autoconnect', ['autoconnect' => $autoconnect], $locale) !!}</p>

        <p>{{ __('mails/generic.closing', [], $locale) }}</p>
        <p>{!! $signature !!}</p>
    </div>
</x-front-mail-layout>
