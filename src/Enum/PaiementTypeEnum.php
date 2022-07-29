<?php

namespace App\Enum;

use App\Trait\EnumToArrayTrait;

enum PaiementTypeEnum: string {
    use EnumToArrayTrait;

    case ENTRANT = 'Entrant';
    case SORTANT = 'Sortant';
}
