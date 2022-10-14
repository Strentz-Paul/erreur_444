<?php

namespace App\Service;


use App\Contracts\Manager\EntrepriseManagerInterface;
use App\Contracts\Service\ComptabiliteServiceInterface;
use App\Dto\SimulateurDto;
use App\ViewModel\SimulateurVM;
use Doctrine\Common\Collections\Collection;

final class ComptabiliteService implements ComptabiliteServiceInterface
{
    public function __construct(private EntrepriseManagerInterface $entrepriseManager)
    {}

    /**
     * {@inheritDoc}
     */
    public function getAllEntreprises(bool $showExternal): Collection
    {
        return $this->entrepriseManager->getAllEntreprises($showExternal);
    }

    /**
     * {@inheritDoc}
     */
    public function calculSalaireByDto(SimulateurDto $dto): SimulateurVM
    {
        if (
            ($dto->getTjm() === null || $dto->getTjm() <= 0) ||
            ($dto->getNbJours() === null || $dto->getNbJours() <= 0) ||
            ($dto->getTauxImpots() === null || $dto->getTauxImpots() <= 0)
        ) {
            return new SimulateurVM(0, 0, 0, 0, 0);
        }
        $salaireAnnuel = $this->calculSalaire(
            (float)$dto->getTjm(),
            $dto->getNbJours(),
            $dto->getTauxImpots(),
            $dto->getPalierTVA(),
            $dto->getTauxTVA(),
            true
        );
        $salaireMensuel = $this->calculSalaire(
            (float)$dto->getTjm(),
            $dto->getNbJours(),
            $dto->getTauxImpots(),
            $dto->getPalierTVA(),
            $dto->getTauxTVA(),
            false
        );
        $nbJoursAvantPalier = $this->calculNbJoursAvantPalier(
            $dto->getNbJours(),
            $dto->getTjm(),
            $dto->getPalierTVA(),
            $dto->getTauxTVA()
        );
        $tjmApplicableAvantTVA = $this->calculTjmApplicableAvantTva(
            $dto->getTjm(),
            $dto->getTauxTVA()
        );
        $caAnnuel = $this->calculCAAnnuel($dto->getTjm(), $dto->getNbJours(), $nbJoursAvantPalier, $tjmApplicableAvantTVA);
        return new SimulateurVM(
            $salaireAnnuel,
            $salaireMensuel,
            $nbJoursAvantPalier,
            $tjmApplicableAvantTVA,
            $caAnnuel
        );
    }

    /**
     * @param float $tjm
     * @param int $nbJours
     * @param float $tauxImpots
     * @param int $palierTVA
     * @param float $tauxTVA
     * @param bool $yearly
     * @return float
     */
    private function calculSalaire(
        float $tjm,
        int $nbJours,
        float $tauxImpots,
        int $palierTVA,
        float $tauxTVA,
        bool $yearly
    ): float {
        $total = 0;
        $caSansTVA = 0;
        for ($i = 0; $i < $nbJours; $i++) {
            $caSansTVA += $tjm;
            $tjmSansCharge = $tjm - (($tjm*22)/100);
            $tjmSansImpotsEtCharge = $tjmSansCharge - (($tjmSansCharge*$tauxImpots)/100);
            if ($caSansTVA < $palierTVA) {
                $bonus = (($tjm * $tauxTVA) / 100);
                $caSansTVA += $bonus;
                $tjmChanged = $tjm + $bonus;
                $tjmSansCharge = $tjmChanged - (($tjmChanged*22)/100);
                $tjmSansImpotsEtCharge = $tjmSansCharge - (($tjmSansCharge*$tauxImpots)/100);
            }
            $total += $tjmSansImpotsEtCharge;
        }
        if ($yearly === false) {
            $total /= 12;
        }
        return round($total, 2);
    }

    /**
     * @param int $nbJours
     * @param float $tjm
     * @param int $palierTVA
     * @param float $tauxTva
     * @return int
     */
    private function calculNbJoursAvantPalier(
        int $nbJours,
        float $tjm,
        int $palierTVA,
        float $tauxTva
    ): int {
        $caSansTVA = 0;
        $nbDay = 0;
        if ($palierTVA === 0) {
            return 0;
        }
        for ($i = 0; $i < $nbJours; $i++) {
            $nbDay++;
            $caSansTVA += $tjm;
            $bonus = (($tjm * $tauxTva) / 100);
            $caSansTVA += $bonus;
            if (($caSansTVA + $tjm + $bonus) > $palierTVA) {
                return $nbDay;
            }
        }
        return 0;
    }

    /**
     * @param float $tjm
     * @param float $tauxTva
     * @return float
     */
    private function calculTjmApplicableAvantTva(
        float $tjm,
        float $tauxTva
    ): float {
        return $tjm + (($tjm*$tauxTva)/100);
    }

    /**
     * @param float $tjm
     * @param int $nbJours
     * @param int $nbJoursAvantPalier
     * @param float $tjmApplicableAvantTVA
     * @return float
     */
    private function calculCAAnnuel(
        float $tjm,
        int $nbJours,
        int $nbJoursAvantPalier,
        float $tjmApplicableAvantTVA
    ): float {
        return ($tjm * ($nbJours - $nbJoursAvantPalier))+(($tjmApplicableAvantTVA * $nbJoursAvantPalier));
    }
}
