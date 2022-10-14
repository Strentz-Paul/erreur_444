<?php

namespace App\Dto;

use App\Entity\Entreprise;
use App\Enum\DevisStatutEnum;

class DevisDto
{
    private ?int $nbJours;
    private ?float $tjm;
    private DevisStatutEnum $statut;
    private bool $completed = false;
    private Entreprise $entreprise;
    private ?string $client;

    /**
     * @return DevisStatutEnum
     */
    public function getStatut(): DevisStatutEnum
    {
        return $this->statut;
    }

    /**
     * @param string $statut
     * @return DevisDto
     */
    public function setStatut(string $statut): DevisDto
    {
        $this->statut = DevisStatutEnum::from($statut);
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
     * @return DevisDto
     */
    public function setNbJours(?int $nbJours): DevisDto
    {
        $this->nbJours = $nbJours;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTjm(): ?float
    {
        return $this->tjm;
    }

    /**
     * @param float|null $tjm
     * @return DevisDto
     */
    public function setTjm(?float $tjm): DevisDto
    {
        $this->tjm = $tjm;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->completed;
    }

    /**
     * @param bool $completed
     * @return DevisDto
     */
    public function setCompleted(bool $completed): DevisDto
    {
        $this->completed = $completed;
        return $this;
    }

    /**
     * @return Entreprise
     */
    public function getEntreprise(): Entreprise
    {
        return $this->entreprise;
    }

    /**
     * @param Entreprise $entreprise
     * @return DevisDto
     */
    public function setEntreprise(Entreprise $entreprise): DevisDto
    {
        $this->entreprise = $entreprise;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getClient(): ?string
    {
        return $this->client;
    }

    /**
     * @param string|null $client
     * @return DevisDto
     */
    public function setClient(?string $client): DevisDto
    {
        $this->client = $client;
        return $this;
    }
}
