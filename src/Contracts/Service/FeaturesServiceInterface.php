<?php

namespace App\Contracts\Service;

use App\ViewModel\FeaturesVm;

interface FeaturesServiceInterface
{
    /**
     * @return FeaturesVM
     */
    public function getFeatures(): FeaturesVM;
}
