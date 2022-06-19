<?php

namespace App\Enum;

use App\Trait\EnumToArrayTrait;

enum FeaturesEnum: string {
    use EnumToArrayTrait;

    case LIVE_COMPONENTS = 'Live components';
}
