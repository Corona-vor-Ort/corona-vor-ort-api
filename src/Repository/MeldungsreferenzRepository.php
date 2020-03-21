<?php

namespace App\Repository;

use App\Entity\Meldungsreferenz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Meldungsreferenz|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meldungsreferenz|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meldungsreferenz[]    findAll()
 * @method Meldungsreferenz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeldungsreferenzRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meldungsreferenz::class);
    }

    // /**
    //  * @return Meldungsreferenz[] Returns an array of Meldungsreferenz objects
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
    public function findOneBySomeField($value): ?Meldungsreferenz
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
