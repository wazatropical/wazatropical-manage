<?php

namespace WAZA\ComptabiliteBundle\Repository;

/**
 * productionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class productionRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCritere($pattern){
        $qb = $this->createQueryBuilder('p');
        $qb->Where('p.nom LIKE :pattern')
            ->orWhere('p.description LIKE :pattern')
            ->orWhere('p.beneficev LIKE :pattern')
            ->orWhere('p.budget LIKE :pattern')
            ->setParameter('pattern', '%' .$pattern. '%');
        return $qb->getQuery()->getResult();
    }
}
