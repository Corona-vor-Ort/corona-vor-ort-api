<?php

namespace App\Repository;

use App\Entity\StateTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StateTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method StateTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method StateTranslation[]    findAll()
 * @method StateTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StateTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StateTranslation::class);
    }

    // /**
    //  * @return StateTranslation[] Returns an array of StateTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StateTranslation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
