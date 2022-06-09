<?php

namespace App\Manager;

use App\Contracts\Manager\CommentaireManagerInterface;
use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;

final class CommentaireManager implements CommentaireManagerInterface
{
    private CommentaireRepository $commentaireRepository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $repo = $entityManager->getRepository(Commentaire::class);
        if (!$repo instanceof CommentaireRepository) {
            throw new InvalidArgumentException(sprintf(
                'The repository class for "%s" must be "%s" and given "%s"! ' .
                'Maybe look the "repositoryClass" declaration on %s ?',
                Commentaire::class,
                EntityManagerInterface::class,
                get_class($repo),
                Commentaire::class
            ));
        }
        $this->commentaireRepository = $repo;
    }

    /**
     * {@inheritDoc}
     */
    public function createOrUpdate(Commentaire $commentaire, bool $flush = true): void
    {
        /** @var int|null $id */
        $id = $commentaire->getId();
        if ($id === null) {
            $this->entityManager->persist($commentaire);
        }
        if ($flush === true) {
            $this->entityManager->flush();
        }
    }
}
