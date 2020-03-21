<?php

namespace App\Repository;

use App\Entity\CityZipCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CityZipCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method CityZipCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method CityZipCode[]    findAll()
 * @method CityZipCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityZipCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CityZipCode::class);
    }

    // /**
    //  * @return CityZipCode[] Returns an array of CityZipCode objects
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
    public function findOneBySomeField($value): ?CityZipCode
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
