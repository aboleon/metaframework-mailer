<?php

use App\Enum\PaymentCallState;
use MetaFramework\Accessors\Prices;

$text = $mailed->accessor->accountNames();


$text .= match ($mailed->paymentState()) {
    PaymentCallState::SUCCESS->value => " a payé sa caution d'un montant",
    default => " a essayé mais n'a pas réuissi à payer sa caution",
};


$text .= " de ".Prices::readableFormat($mailed->amount(), showDecimals: false)
    ." pour la prise en charge dans le cade de l'évènement".$mailed->accessor->eventName();


if ( ! in_array(
    $mailed->paymentState(),
    [PaymentCallState::SUCCESS->value, PaymentCallState::default()],
)
) {
    $text .= "<br><br>Le paiement a été ".Str::lower(PaymentCallState::translated($mailed->paymentState()));
}

if ($mailed->paymentState() == PaymentCallState::default()) {
    $text .= "<br><br>Le paiement est toujours ".Str::lower(
            PaymentCallState::translated($mailed->paymentState()),
        );
}

?>
<x-mail-layout :banner="$banner">
    {!! $text !!}
</x-mail-layout>
