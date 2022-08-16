<?php

namespace App\Contracts\Manager;

use Doctrine\Common\Collections\Collection;

interface EntrepriseManagerInterface
{
    /**
     * @return Collection
     */
    public function getAllEntreprises(): Collection;
}
