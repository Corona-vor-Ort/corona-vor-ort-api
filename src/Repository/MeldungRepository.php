<?php

namespace App\Repository;

use App\Entity\Meldung;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Meldung|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meldung|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meldung[]    findAll()
 * @method Meldung[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeldungRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meldung::class);
    }

    public function findByBbkIdentifier($bbkId): ?Meldung
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.bbk_identifier = :bbkId')
            ->setParameter('bbkId', $bbkId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    

    // /**
    //  * @return Meldung[] Returns an array of Meldung objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Meldung
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
