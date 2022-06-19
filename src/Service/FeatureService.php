<?php

namespace App\Service;

use App\Enum\FeaturesEnum;
use App\ViewModel\FeaturesVm;
use App\Contracts\Service\FeaturesServiceInterface;
use App\ViewModel\FeatureVM;
use Symfony\Contracts\Translation\TranslatorInterface;

final class FeatureService implements FeaturesServiceInterface
{
    public function __construct(
        private TranslatorInterface $translator
    ){}

    /**
     * @return FeaturesVm
     */
    public function getFeatures(): FeaturesVM
    {
        $features = new FeaturesVm();
        $enums = FeaturesEnum::values();
        foreach ($enums as $e) {
            match ($e) {
                FeaturesEnum::LIVE_COMPONENTS->value => $feature = new FeatureVM(
                    $this->translator->trans('feature.live_component.title'),
                    $this->translator->trans('feature.live_component.description'),
                    'features_live_component'
                )
            };
            $features->addFeature($feature);
        }
        return $features;
    }
}
