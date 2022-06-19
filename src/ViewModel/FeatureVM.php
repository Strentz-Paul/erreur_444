<?php

namespace App\ViewModel;

final class FeatureVM
{
    public function __construct(
        private string $titre,
        private string $shortDescription,
        private string $urlToFeature
    ){}

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }

    /**
     * @return string
     */
    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    /**
     * @return string
     */
    public function getUrlToFeature(): string
    {
        return $this->urlToFeature;
    }
}
