<?php

namespace App\Contracts\Service;

use App\Dto\SimulateurDto;
use App\ViewModel\SimulateurVM;
use Doctrine\Common\Collections\Collection;

interface ComptabiliteServiceInterface
{
    /**
     * @param bool $showExternal
     * @return Collection
     */
    public function getAllEntreprises(bool $showExternal): Collection;

    /**
     * @param SimulateurDto $dto
     * @return SimulateurVM
     */
    public function calculSalaireByDto(SimulateurDto $dto): SimulateurVM;
}
