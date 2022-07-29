<?php

namespace App\Enum;

use App\Trait\EnumToArrayTrait;

enum DevisStatutEnum: string {
    use EnumToArrayTrait;

    case PREPARATION = 'Préparation';
    case ENVOYE = 'Envoyé';
    case SIGNE = 'Signé';
    case REFUSE = 'Refusé';
    case NEGOCIATION = 'Négociation';
}
