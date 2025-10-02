<x-mail-layout :banner="$banner">
    {{ $greeting }}
<br><br>
    {!! $body !!}
    <br><br>
    {{ $closing }}
</x-mail-layout>
