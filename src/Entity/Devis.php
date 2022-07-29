<?php

namespace App\Entity;

use App\Enum\DevisStatutEnum;
use App\Repository\DevisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevisRepository::class)]
class Devis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Bilan::class, inversedBy: 'devis')]
    #[ORM\JoinColumn(nullable: false)]
    private $bilan;

    #[ORM\Column(type: 'string', enumType: DevisStatutEnum::class)]
    private $statut;

    #[ORM\Column(type: 'boolean')]
    private $completed;

    #[ORM\OneToOne(mappedBy: 'devis', targetEntity: Mission::class, cascade: ['persist', 'remove'])]
    private $mission;

    #[ORM\Column(nullable: true)]
    private ?int $nbJours = null;

    #[ORM\Column]
    private ?float $tjm = null;

    public function __construct()
    {
        $this->statut = DevisStatutEnum::PREPARATION;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBilan(): ?Bilan
    {
        return $this->bilan;
    }

    public function setBilan(?Bilan $bilan): self
    {
        $this->bilan = $bilan;

        return $this;
    }

    public function getStatut(): ?DevisStatutEnum
    {
        return $this->statut;
    }

    public function setStatut(DevisStatutEnum $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function isCompleted(): ?bool
    {
        return $this->completed;
    }

    public function setCompleted(bool $completed): self
    {
        $this->completed = $completed;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(Mission $mission): self
    {
        // set the owning side of the relation if necessary
        if ($mission->getDevis() !== $this) {
            $mission->setDevis($this);
        }

        $this->mission = $mission;

        return $this;
    }

    public function getNbJours(): ?int
    {
        return $this->nbJours;
    }

    public function setNbJours(?int $nbJours): self
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    public function getTjm(): ?float
    {
        return $this->tjm;
    }

    public function setTjm(float $tjm): self
    {
        $this->tjm = $tjm;

        return $this;
    }
}
