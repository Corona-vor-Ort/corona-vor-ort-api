<?php

namespace App\Repository;

use App\Entity\Kreis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Kreis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kreis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kreis[]    findAll()
 * @method Kreis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KreisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kreis::class);
    }

    // /**
    //  * @return Kreis[] Returns an array of Kreis objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kreis
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
