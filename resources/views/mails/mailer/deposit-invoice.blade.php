<x-mail-layout :banner="$banner">
    Vous avez payé une caution d'un montant de {{$mailed->amount}}€ concernant "{{$mailed->depositName}}"
    pour l'événement {{$event_name}} mais n'êtes pas venu.e.
    <br>
    Votre caution ne vous sera donc pas remboursée.
    <br>
    Vous trouverez ici la facture correspondante.
    <br>
    Cela concerne : {{ $names }}
</x-mail-layout>
