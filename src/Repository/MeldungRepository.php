<?php

namespace App\Repository;

use App\Entity\Meldung;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Meldung|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meldung|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meldung[]    findAll()
 * @method Meldung[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeldungRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meldung::class);
    }

    public function findByZipCode($zip)
    {
        /**
         * TODO: Meldungen an Hand der PLZ finden
         */
        return $this->findAll();
    }
}
