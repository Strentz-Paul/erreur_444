<?php

namespace App\Components;


use App\Contracts\Service\ComptabiliteServiceInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('live_simulateur')]
class LiveSimulateurComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $tjm = 0;
    #[LiveProp(writable: true)]
    public int $nbJours = 0;
    #[LiveProp(writable: true)]
    public float $tauxImpots = 0;
    #[LiveProp(writable: true)]
    public int $palierTVA = 34400;
    #[LiveProp(writable: true)]
    public float $tauxTVA = 19.5;
    #[LiveProp(writable: true)]
    public int $chiffreAffaireAnnuel = 0;
    #[LiveProp(writable: true)]
    public int $salaireDisponibleMensuel = 0;
    #[LiveProp(writable: false)]
    public string $infoForm = 'admin.compta.simulateur.misconfigurated';
    #[LiveProp]
    public bool $isValid = false;

    public function __construct(
        private ComptabiliteServiceInterface $comptabiliteService
    ){}

    public function isValid(): bool
    {
        return $this->tjm > 0
            && $this->nbJours > 0
            && $this->tauxImpots > 0
            && $this->palierTVA > 0
            && $this->tauxTVA > 0;
    }

    public function getChiffreAffaireAnnuel(): int
    {
        if ($this->isValid === true) {
            return 0;
        }
        return $this->comptabiliteService->calculSalaire(
            $this->tjm,
            $this->nbJours,
            $this->tauxImpots,
            $this->palierTVA,
            $this->tauxTVA,
            true
        );
    }

}
