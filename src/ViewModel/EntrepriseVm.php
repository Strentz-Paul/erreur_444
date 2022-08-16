<?php

namespace App\ViewModel;


use DateTime;

final class EntrepriseVm
{
    public function __construct(
        private int $id,
        private string $nom,
        private string $statutJuridique,
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
        return $this->statutJuridique;
    }

    /**
     * @return DateTime
     */
    public function getDateDebut(): DateTime
    {
        return $this->dateDebut;
    }
}
