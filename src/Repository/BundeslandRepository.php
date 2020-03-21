<?php

namespace App\Repository;

use App\Entity\Bundesland;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bundesland|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bundesland|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bundesland[]    findAll()
 * @method Bundesland[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BundeslandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bundesland::class);
    }

    // /**
    //  * @return Bundesland[] Returns an array of Bundesland objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bundesland
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
