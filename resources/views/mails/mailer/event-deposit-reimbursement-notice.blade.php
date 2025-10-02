<x-mail-layout :banner="$banner">
    Nous venons de procéder au remboursement de la caution d'un montant de {{ $mailed->amount }}€
    que vous avez payée concernant {{ $mailed->depositName }} pour {{ $event_name}}.
    <br>
    Cela concerne : {{ $names }}
</x-mail-layout>
