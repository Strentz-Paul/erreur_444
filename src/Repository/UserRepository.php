<?php

namespace App\Repository;

use App\Entity\User;
use App\Helper\DoctrineHelper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }

    /**
     * @param string $displayName
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function findOneByDisplayName(string $displayName): ?User
    {
        $uAlias = DoctrineHelper::ALIAS_USER;
        $query = $this->createQueryBuilder($uAlias);
        self::addDisplayNameConstraint($query, $displayName, $uAlias);
        return $query->getQuery()->getOneOrNullResult();
    }

    /**
     * @param QueryBuilder $query
     * @param string $displayName
     * @param string $uAlias
     * @return QueryBuilder
     */
    public static function addDisplayNameConstraint(
        QueryBuilder $query,
        string $displayName,
        string $uAlias = DoctrineHelper::ALIAS_USER
    ): QueryBuilder {
        return self::addDisplayNameWhere($query, $displayName, $uAlias);
    }

    /**
     * @param QueryBuilder $query
     * @param string $displayName
     * @param string $uAlias
     * @return QueryBuilder
     */
    public static function addDisplayNameWhere(
        QueryBuilder $query,
        string $displayName,
        string $uAlias = DoctrineHelper::ALIAS_USER
    ): QueryBuilder {
        $query->andWhere("$uAlias.displayName = :displayName")
            ->setParameter("displayName", $displayName);
        return $query;
    }
}
