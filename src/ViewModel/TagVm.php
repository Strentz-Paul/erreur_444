<?php

namespace App\ViewModel;

final class TagVm
{
    private string $intitule;
    private string $colorHexa;

    public function __construct(
        string $intitule,
        string $colorHexa
    ) {
        $this->intitule = $intitule;
        $this->colorHexa = $colorHexa;
    }

    /**
     * @return string
     */
    public function getIntitule(): string
    {
        return $this->intitule;
    }

    /**
     * @return string
     */
    public function getColorHexa(): string
    {
        return $this->colorHexa;
    }
}
