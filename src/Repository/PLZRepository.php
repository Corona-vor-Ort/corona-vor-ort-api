<?php

namespace App\Repository;

use App\Entity\PLZ;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PLZ|null find($id, $lockMode = null, $lockVersion = null)
 * @method PLZ|null findOneBy(array $criteria, array $orderBy = null)
 * @method PLZ[]    findAll()
 * @method PLZ[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PLZRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PLZ::class);
    }

    // /**
    //  * @return PLZ[] Returns an array of PLZ objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PLZ
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
