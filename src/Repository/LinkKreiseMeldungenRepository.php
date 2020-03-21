<?php

namespace App\Repository;

use App\Entity\LinkKreiseMeldungen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LinkKreiseMeldungen|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkKreiseMeldungen|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkKreiseMeldungen[]    findAll()
 * @method LinkKreiseMeldungen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkKreiseMeldungenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkKreiseMeldungen::class);
    }

    // /**
    //  * @return LinkKreiseMeldungen[] Returns an array of LinkKreiseMeldungen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LinkKreiseMeldungen
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
