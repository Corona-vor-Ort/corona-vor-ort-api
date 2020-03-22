<?php

namespace App\Repository;

use App\Entity\MeldungLink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MeldungLink|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeldungLink|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeldungLink[]    findAll()
 * @method MeldungLink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeldungLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeldungLink::class);
    }

    public function findByLinkForMeldung($link, $meldung)
    {
        $q = $this->createQueryBuilder('ml');
        $q->select('ml')
            ->andWhere('ml.link = :link')
            ->setParameter('link', $link)
            ->andWhere('ml.meldung = :meldung')
            ->setParameter('meldung', $meldung);
        return $q->getQuery()->getOneOrNullResult();
    }
}
