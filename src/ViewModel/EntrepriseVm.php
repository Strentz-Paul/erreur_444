<?php

namespace App\ViewModel;


use App\Enum\StatutJuridiqueEnum;
use DateTime;

final class EntrepriseVm
{
    public function __construct(
        private int $id,
        private string $nom,
        private StatutJuridiqueEnum $statutJuridique,
        private DateTime $dateDebut
    ){}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return string
     */
    public function getStatutJuridique(): string
    {
        return $this->statutJuridique->value;
    }

    /**
     * @return DateTime
     */
    public function getDateDebut(): DateTime
    {
        return $this->dateDebut;
    }
}
