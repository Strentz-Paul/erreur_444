<?php

namespace App\Contracts\Service;

use Doctrine\Common\Collections\Collection;

interface ComptabiliteServiceInterface
{
    /**
     * @param bool $showExternal
     * @return Collection
     */
    public function getAllEntreprises(bool $showExternal): Collection;
}
