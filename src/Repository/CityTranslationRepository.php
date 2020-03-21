<?php

namespace App\Repository;

use App\Entity\CityTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CityTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method CityTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method CityTranslation[]    findAll()
 * @method CityTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CityTranslation::class);
    }

    // /**
    //  * @return CityTranslation[] Returns an array of CityTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CityTranslation
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
