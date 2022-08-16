<?php

namespace App\Service;


use App\Contracts\Manager\EntrepriseManagerInterface;
use App\Contracts\Service\ComptabiliteServiceInterface;
use Doctrine\Common\Collections\Collection;

final class ComptabiliteService implements ComptabiliteServiceInterface
{
    public function __construct(private EntrepriseManagerInterface $entrepriseManager)
    {}

    /**
     * {@inheritDoc}
     */
    public function getAllEntreprises(): Collection
    {
        return $this->entrepriseManager->getAllEntreprises();
    }
}
