<?php

namespace WAZA\ComptabiliteBundle\Repository;

/**
 * possederobjgainRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class possederobjgainRepository extends \Doctrine\ORM\EntityRepository
{
    /*public function findCritere($pattern){
        $qb = $this->createQueryBuilder('o');
        $qb->Where('o.description LIKE :pattern')
            ->orWhere('o.nom LIKE :pattern')
            ->setParameter('pattern', '%' .$pattern. '%');
        return $qb->getQuery()->getResult();
    }*/
    public function findByGainObjetNotNull($idGain){
        $qb = $this->createQueryBuilder('p');
        $qb->Where('p.gain = :idgain')
            ->andWhere('p.objet is not NULL')
            ->setParameter('idgain', $idGain);
        return $qb->getQuery()->getResult();
    }
    
    public function findRelation($idGain, $idObjet, $dateGain, $responsable){
        $qb = $this->createQueryBuilder('p');
        $qb->Where('p.gain = :idgain')
            ->andWhere('p.objet = :idobjet')
            ->andWhere('p.date = :dateGain')
            ->andWhere('p.responsable = :responsable')
            ->setParameter('idgain', $idGain)
            ->setParameter('idobjet', $idObjet)
            ->setParameter('dateGain', $dateGain)
            ->setParameter('responsable', $responsable);
        return $qb->getQuery()->getResult();
    }
}
