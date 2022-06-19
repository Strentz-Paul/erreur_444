<?php

namespace App\Contracts\Service;

interface FeaturesServiceInterface
{
    /**
     * @return FeaturesVM
     */
    public function getFeatures(): FeaturesVM;
}
