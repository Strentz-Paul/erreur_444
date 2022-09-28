<?php

namespace App\Contracts\Manager;

use App\Dto\EntrepriseDto;
use App\Entity\Entreprise;
use Doctrine\Common\Collections\Collection;

interface EntrepriseManagerInterface
{
    /**
     * @param Entreprise $entreprise
     * @param bool $flush
     * @return void
     */
    public function createOrUpdate(Entreprise $entreprise, bool $flush = true): void;

    /**
     * @param bool $showExternal
     * @return Collection
     */
    public function getAllEntreprises(bool $showExternal): Collection;

    /**
     * @param EntrepriseDto $dto
     * @return Entreprise
     */
    public function createEntrepriseByDto(EntrepriseDto $dto): Entreprise;
}
