<?php

namespace App\Repository;

use App\Entity\MeldungKeyword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MeldungKeyword|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeldungKeyword|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeldungKeyword[]    findAll()
 * @method MeldungKeyword[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeldungKeywordRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeldungKeyword::class);
    }

    // /**
    //  * @return MeldungKeyword[] Returns an array of MeldungKeyword objects
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
    public function findOneBySomeField($value): ?MeldungKeyword
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
