<?php

namespace WAZA\ComptabiliteBundle\Repository;

/**
 * possederobjdepRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class possederobjdepRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByGainObjetNotNull($idDep){
        $qb = $this->createQueryBuilder('p');
        $qb->Where('p.depense = :iddep')
            ->andWhere('p.objet is not NULL')
            ->setParameter('iddep', $idDep);
        return $qb->getQuery()->getResult();
    }
    
    public function findRelation($idDep, $idObjet, $dateDep, $responsable){
        $qb = $this->createQueryBuilder('p');
        $qb->Where('p.depense = :iddep')
            ->andWhere('p.objet = :idobjet')
            ->andWhere('p.date = :dateDep')
            ->andWhere('p.responsable = :responsable')
            ->setParameter('iddep', $idDep)
            ->setParameter('idobjet', $idObjet)
            ->setParameter('dateDep', $dateDep)
            ->setParameter('responsable', $responsable);
        return $qb->getQuery()->getResult();
    }
}