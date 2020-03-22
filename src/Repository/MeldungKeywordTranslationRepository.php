<?php

namespace App\Repository;

use App\Entity\MeldungKeywordTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MeldungKeywordTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeldungKeywordTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeldungKeywordTranslation[]    findAll()
 * @method MeldungKeywordTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeldungKeywordTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeldungKeywordTranslation::class);
    }

    // /**
    //  * @return MeldungKeywordTranslation[] Returns an array of MeldungKeywordTranslation objects
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
    public function findOneBySomeField($value): ?MeldungKeywordTranslation
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
