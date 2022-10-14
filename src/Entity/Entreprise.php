<?php

namespace App\Entity;

use App\Enum\StatutJuridiqueEnum;
use App\Repository\EntrepriseRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateDebut;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateFin;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Bilan::class, orphanRemoval: true)]
    private $bilans;

    #[ORM\Column(type: 'string', enumType: StatutJuridiqueEnum::class)]
    private $statutJuridique;

    #[ORM\Column(type: 'boolean')]
    private $isExterne;

    #[ORM\ManyToMany(targetEntity: Personne::class, mappedBy: 'entreprise')]
    private $personnes;

    public function __construct()
    {
        $this->bilans = new ArrayCollection();
        $this->statutJuridique = StatutJuridiqueEnum::UNDEFINED;
        $this->personnes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->nom ?? '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * @return Collection<int, Bilan>
     */
    public function getBilans(): Collection
    {
        return $this->bilans;
    }

    public function addBilan(Bilan $bilan): self
    {
        if (!$this->bilans->contains($bilan)) {
            $this->bilans[] = $bilan;
            $bilan->setEntreprise($this);
        }

        return $this;
    }

    public function removeBilan(Bilan $bilan): self
    {
        if ($this->bilans->removeElement($bilan)) {
            // set the owning side to null (unless already changed)
            if ($bilan->getEntreprise() === $this) {
                $bilan->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getStatutJuridique(): ?StatutJuridiqueEnum
    {
        return $this->statutJuridique;
    }

    public function setStatutJuridique(StatutJuridiqueEnum $statutJuridique): self
    {
        $this->statutJuridique = $statutJuridique;

        return $this;
    }

    public function isIsExterne(): ?bool
    {
        return $this->isExterne;
    }

    public function setIsExterne(bool $isExterne): self
    {
        $this->isExterne = $isExterne;

        return $this;
    }

    /**
     * @return Collection<int, Personne>
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
            $personne->addEntreprise($this);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        if ($this->personnes->removeElement($personne)) {
            $personne->removeEntreprise($this);
        }

        return $this;
    }

    /**
     * @param string $nom
     * @param StatutJuridiqueEnum $statut
     * @param bool $isExterne
     * @param DateTime|null $dateDebut
     * @return Entreprise
     */
    public static function create(
        string $nom,
        StatutJuridiqueEnum $statut,
        bool $isExterne,
        ?DateTime $dateDebut
    ): Entreprise {
        $entreprise = new Entreprise();
        $entreprise->setNom($nom)
            ->setStatutJuridique($statut)
            ->setIsExterne($isExterne)
            ->setDateDebut($dateDebut);
        return $entreprise;
    }
}
