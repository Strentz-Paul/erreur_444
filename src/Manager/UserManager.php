<?php

namespace App\Manager;

use App\Contracts\Manager\UserManagerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use App\ViewModel\UserVm;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
use Symfony\Component\Security\Http\Controller\UserValueResolver;

final class UserManager implements UserManagerInterface
{
    private UserRepository $userRepository;

    public function __construct(private EntityManagerInterface $entityManager)
    {
        $repo = $entityManager->getRepository(User::class);
        if (!$repo instanceof UserRepository) {
            throw new InvalidArgumentException(sprintf(
                'The repository class for "%s" must be "%s" and given "%s"! ' .
                'Maybe look the "repositoryClass" declaration on %s ?',
                Tag::class,
                EntityManagerInterface::class,
                get_class($repo),
                Tag::class
            ));
        }
        $this->userRepository = $repo;
    }

    /**
     * {@inheritDoc}
     */
    public function createOrUpdate(User $user, bool $flush = true): void
    {
        /** @var int|null $id */
        $id = $user->getId();
        if ($id === null) {
            $this->entityManager->persist($user);
        }
        if ($flush === true) {
            $this->entityManager->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function findOneByDisplayName(string $displayName): ?UserVm
    {
        $user = $this->userRepository->findOneByDisplayName($displayName);
        if ($user === null) {
            return null;
        }
        return new UserVM($user);
    }
}
