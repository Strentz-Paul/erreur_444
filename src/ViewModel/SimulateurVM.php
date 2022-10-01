<?php

namespace App\ViewModel;

final class SimulateurVM
{
    public function __construct(
        private float $salaireAnnuel,
        private float $salaireMensuel,
        private int $nbDeJoursAvantPalierTVA,
        private float $tjmApplicableAvantTVA
    ){}

    /**
     * @return float
     */
    public function getSalaireAnnuel(): float
    {
        return $this->salaireAnnuel;
    }

    /**
     * @return float
     */
    public function getSalaireMensuel(): float
    {
        return $this->salaireMensuel;
    }

    /**
     * @return int
     */
    public function getNbDeJoursAvantPalierTVA(): int
    {
        return $this->nbDeJoursAvantPalierTVA;
    }

    /**
     * @return float
     */
    public function getTjmApplicableAvantTVA(): float
    {
        return $this->tjmApplicableAvantTVA;
    }
}
