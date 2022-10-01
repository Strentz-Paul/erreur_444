<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class SimulateurDto
{
    #[Assert\GreaterThan(0)]
    private ?int $tjm;
    #[Assert\GreaterThan(0)]
    private ?int $nbJours;
    #[Assert\GreaterThan(0)]
    private ?float $tauxImpots;
    #[Assert\GreaterThan(0)]
    private int $palierTVA = 34400;
    #[Assert\GreaterThan(0)]
    private float $tauxTVA = 19.5;

    /**
     * @return int|null
     */
    public function getTjm(): ?int
    {
        return $this->tjm;
    }

    /**
     * @param int|null $tjm
     * @return SimulateurDto
     */
    public function setTjm(?int $tjm): SimulateurDto
    {
        $this->tjm = $tjm;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNbJours(): ?int
    {
        return $this->nbJours;
    }

    /**
     * @param int|null $nbJours
     * @return SimulateurDto
     */
    public function setNbJours(?int $nbJours): SimulateurDto
    {
        $this->nbJours = $nbJours;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTauxImpots(): ?float
    {
        return $this->tauxImpots;
    }

    /**
     * @param float|null $tauxImpots
     * @return SimulateurDto
     */
    public function setTauxImpots(?float $tauxImpots): SimulateurDto
    {
        $this->tauxImpots = $tauxImpots;
        return $this;
    }

    /**
     * @return int
     */
    public function getPalierTVA(): int
    {
        return $this->palierTVA;
    }

    /**
     * @param int $palierTVA
     * @return SimulateurDto
     */
    public function setPalierTVA(int $palierTVA): SimulateurDto
    {
        $this->palierTVA = $palierTVA;
        return $this;
    }

    /**
     * @return float
     */
    public function getTauxTVA(): float
    {
        return $this->tauxTVA;
    }

    /**
     * @param float $tauxTVA
     * @return SimulateurDto
     */
    public function setTauxTVA(float $tauxTVA): SimulateurDto
    {
        $this->tauxTVA = $tauxTVA;
        return $this;
    }
}
