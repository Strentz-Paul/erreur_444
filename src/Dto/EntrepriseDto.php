<?php

namespace App\Dto;

use App\Entity\Article;
use App\Enum\StatutJuridiqueEnum;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class EntrepriseDto
{
    private string $nom;
    private ?DateTime $dateDebut;
    private ?DateTime $dateFin;
    private StatutJuridiqueEnum $statutJuridique;
    private bool $isExterne;

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     * @return EntrepriseDto
     */
    public function setNom(string $nom): EntrepriseDto
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateDebut(): ?DateTime
    {
        return $this->dateDebut;
    }

    /**
     * @param DateTime|null $dateDebut
     * @return EntrepriseDto
     */
    public function setDateDebut(?DateTime $dateDebut): EntrepriseDto
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getDateFin(): ?DateTime
    {
        return $this->dateFin;
    }

    /**
     * @param DateTime|null $dateFin
     * @return EntrepriseDto
     */
    public function setDateFin(?DateTime $dateFin): EntrepriseDto
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    /**
     * @return StatutJuridiqueEnum
     */
    public function getStatutJuridique(): StatutJuridiqueEnum
    {
        return $this->statutJuridique;
    }

    /**
     * @param StatutJuridiqueEnum $statutJuridique
     * @return EntrepriseDto
     */
    public function setStatutJuridique(StatutJuridiqueEnum $statutJuridique): EntrepriseDto
    {
        $this->statutJuridique = $statutJuridique;
        return $this;
    }

    /**
     * @return bool
     */
    public function isExterne(): bool
    {
        return $this->isExterne;
    }

    /**
     * @param bool $isExterne
     * @return EntrepriseDto
     */
    public function setIsExterne(bool $isExterne): EntrepriseDto
    {
        $this->isExterne = $isExterne;
        return $this;
    }
}
