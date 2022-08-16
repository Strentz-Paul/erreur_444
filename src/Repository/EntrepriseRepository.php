<?php

namespace App\Repository;

use App\Entity\Entreprise;
use App\Helper\DoctrineHelper;
use App\ViewModel\EntrepriseVm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Entreprise>
 *
 * @method Entreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Entreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Entreprise[]    findAll()
 * @method Entreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entreprise::class);
    }

    public function add(Entreprise $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Entreprise $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Collection
     */
    public function findAllCollection(): Collection
    {
        $eAlias = DoctrineHelper::ALIAS_ENTREPRISE;
        $vm = EntrepriseVm::class;
        $query = $this->_em->createQueryBuilder();
        $query->select("NEW $vm(" .
            "$eAlias.id, " .
            "$eAlias.nom, " .
            "$eAlias.statutJuridique, " .
            "$eAlias.dateDebut" .
            ")");
        $query->from(Entreprise::class, $eAlias);
        self::addExternalConstraint($query, false, $eAlias);
        return new ArrayCollection($query->getQuery()->getResult());
    }

    /**
     * @param QueryBuilder $query
     * @param bool $isExternal
     * @param string $eAlias
     * @return QueryBuilder
     */
    public static function addExternalConstraint(
        QueryBuilder $query,
        bool $isExternal,
        string $eAlias = DoctrineHelper::ALIAS_ENTREPRISE
    ): QueryBuilder {
        return self::addExternalWhere($query, $isExternal, $eAlias);
    }

    /**
     * @param QueryBuilder $query
     * @param bool $isExternal
     * @param string $eAlias
     * @return QueryBuilder
     */
    public static function addExternalWhere(
        QueryBuilder $query,
        bool $isExternal,
        string $eAlias = DoctrineHelper::ALIAS_ENTREPRISE
    ): QueryBuilder {
        $condition = $isExternal === false ? "$eAlias.isExterne = 0" : "$eAlias.isExterne = 1";
        $query->andWhere($condition);
        return $query;
    }
}
