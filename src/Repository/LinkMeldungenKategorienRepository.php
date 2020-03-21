<?php

namespace App\Repository;

use App\Entity\LinkMeldungenKategorien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LinkMeldungenKategorien|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkMeldungenKategorien|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkMeldungenKategorien[]    findAll()
 * @method LinkMeldungenKategorien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkMeldungenKategorienRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkMeldungenKategorien::class);
    }

    // /**
    //  * @return LinkMeldungenKategorien[] Returns an array of LinkMeldungenKategorien objects
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
    public function findOneBySomeField($value): ?LinkMeldungenKategorien
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
