<?php

namespace App\Entity;

use App\Enum\PaiementTypeEnum;
use App\Repository\PaiementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $date;

    #[ORM\Column(type: 'string', enumType: PaiementTypeEnum::class)]
    private $type;

    #[ORM\ManyToMany(targetEntity: Mission::class, inversedBy: 'paiements')]
    private $mission;

    #[ORM\ManyToMany(targetEntity: Bilan::class, inversedBy: 'paiements')]
    private $bilan;

    #[ORM\Column(type: 'float')]
    private $valeur;

    public function __construct()
    {
        $this->mission = new ArrayCollection();
        $this->bilan = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getType(): ?PaiementTypeEnum
    {
        return $this->type;
    }

    public function setType(PaiementTypeEnum $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Mission>
     */
    public function getMission(): Collection
    {
        return $this->mission;
    }

    public function addMission(Mission $mission): self
    {
        if (!$this->mission->contains($mission)) {
            $this->mission[] = $mission;
        }

        return $this;
    }

    public function removeMission(Mission $mission): self
    {
        $this->mission->removeElement($mission);

        return $this;
    }

    /**
     * @return Collection<int, Bilan>
     */
    public function getBilan(): Collection
    {
        return $this->bilan;
    }

    public function addBilan(Bilan $bilan): self
    {
        if (!$this->bilan->contains($bilan)) {
            $this->bilan[] = $bilan;
        }

        return $this;
    }

    public function removeBilan(Bilan $bilan): self
    {
        $this->bilan->removeElement($bilan);

        return $this;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }
}
