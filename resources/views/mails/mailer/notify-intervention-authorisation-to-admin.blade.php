<x-mail-layout :banner="$banner">

    <p>{{ $names }} a mis à jour l'autorisation sur l'interventions suivante : {{ $intervention }}</p>

    <p>Autorisation de diffusion {{ __('mails/front/intervention-status.authorisation_type.'. $authorisation_type) .' ' . __('mails/front/intervention-status.status_f.'. $authorisation_status) }}</p>

</x-mail-layout>
