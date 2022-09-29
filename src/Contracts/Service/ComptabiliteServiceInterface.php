<?php

namespace App\Contracts\Service;

use Doctrine\Common\Collections\Collection;

interface ComptabiliteServiceInterface
{
    /**
     * @param bool $showExternal
     * @return Collection
     */
    public function getAllEntreprises(bool $showExternal): Collection;

    /**
     * @param int $tjm
     * @param int $nbJours
     * @param float $tauxImpots
     * @param int $palierTVA
     * @param float $tauxTVA
     * @param bool $yearly
     * @return float
     */
    public function calculSalaire(
        int $tjm,
        int $nbJours,
        float $tauxImpots,
        int $palierTVA,
        float $tauxTVA,
        bool $yearly
    ): float;
}
