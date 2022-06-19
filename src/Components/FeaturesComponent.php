<?php

namespace App\Components;

use App\Contracts\Service\FeaturesServiceInterface;
use App\ViewModel\FeaturesVm;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('features')]
class FeaturesComponent
{
    public function __construct(
        private FeaturesServiceInterface $featuresService
    ){}

    public FeaturesVm $features;

    public function getFeatures(): FeaturesVm
    {
        return $features = $this->featuresService->getFeatures();
    }
}
