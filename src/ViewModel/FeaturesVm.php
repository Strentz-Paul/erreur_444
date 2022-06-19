<?php

namespace App\ViewModel;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class FeaturesVm
{
    private Collection $features;

    public function __construct()
    {
        $this->features = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getFeatures(): Collection
    {
        return $this->features;
    }

    /**
     * @param Collection $features
     * @return FeaturesVm
     */
    public function setFeatures(Collection $features): FeaturesVm
    {
        $this->features = $features;
        return $this;
    }

    public function addFeature(FeatureVM $feature): Collection
    {
        if (!$this->features->contains($feature)) {
            $this->features->add($feature);
        }
        return $this->features;
    }
}
