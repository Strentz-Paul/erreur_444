<?php

namespace App\Contracts\Service;

use Doctrine\Common\Collections\Collection;

interface ComptabiliteServiceInterface
{
    /**
     * @return Collection
     */
    public function getAllEntreprises(): Collection;
}
