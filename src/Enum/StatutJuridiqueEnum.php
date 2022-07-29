<?php

namespace App\Enum;

use App\Trait\EnumToArrayTrait;

enum StatutJuridiqueEnum: string {
    use EnumToArrayTrait;

    case MICRO_ENTREPRISE = 'Micro entreprise';
    case UNDEFINED = 'Non défini';
}
