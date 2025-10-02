<x-mail-layout :banner="$banner">
    Relance de votre commande {{ $order_id }}.<br/>
    Connectez-vous via <a href="{{ $autoconnect }}">ce lien.</a>
</x-mail-layout>
