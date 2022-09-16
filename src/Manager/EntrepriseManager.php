<?php

namespace App\Manager;

use App\Contracts\Manager\EntrepriseManagerInterface;
use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

final class EntrepriseManager implements EntrepriseManagerInterface
{
    private EntrepriseRepository $entrepriseRepo;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $repo = $entityManager->getRepository(Entreprise::class);
        if (!$repo instanceof EntrepriseRepository) {
            throw new InvalidArgumentException(sprintf(
                'The repository class for "%s" must be "%s" and given "%s"! ' .
                'Maybe look the "repositoryClass" declaration on %s ?',
                Entreprise::class,
                EntityManagerInterface::class,
                get_class($repo),
                Entreprise::class
            ));
        }
        $this->entrepriseRepo = $repo;
    }

    /**
     * @inheritDoc
     */
    public function getAllEntreprises(bool $showExternal): Collection
    {
        return $this->entrepriseRepo->findAllCollection($showExternal);
    }

}
