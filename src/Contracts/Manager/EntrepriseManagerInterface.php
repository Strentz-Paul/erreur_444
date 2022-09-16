<?php

namespace App\Contracts\Manager;

use Doctrine\Common\Collections\Collection;

interface EntrepriseManagerInterface
{
    /**
     * @param bool $showExternal
     * @return Collection
     */
    public function getAllEntreprises(bool $showExternal): Collection;
}
