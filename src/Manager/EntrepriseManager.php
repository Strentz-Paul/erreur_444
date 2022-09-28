<?php

namespace App\Manager;

use App\Contracts\Manager\EntrepriseManagerInterface;
use App\Dto\EntrepriseDto;
use App\Entity\Entreprise;
use App\Enum\StatutJuridiqueEnum;
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
    public function createOrUpdate(Entreprise $entreprise, bool $flush = true): void
    {
        /** @var int|null $id */
        $id = $entreprise->getId();
        if ($id === null) {
            $this->entityManager->persist($entreprise);
        }
        if ($flush === true) {
            $this->entityManager->flush();
        }
    }

    /**
     * @inheritDoc
     */
    public function getAllEntreprises(bool $showExternal): Collection
    {
        return $this->entrepriseRepo->findAllCollection($showExternal);
    }

    /**
     * @inheritDoc
     */
    public function createEntrepriseByDto(EntrepriseDto $dto): Entreprise
    {
        $entreprise = Entreprise::create(
            $dto->getNom(),
            $dto->getStatutJuridique(),
            $dto->isExterne(),
            $dto->getDateDebut()
        );
        $this->createOrUpdate($entreprise);
        return $entreprise;
    }
}
