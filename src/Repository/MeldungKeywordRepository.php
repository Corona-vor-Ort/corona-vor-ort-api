<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\MeldungKeyword;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Ramsey\Uuid\Uuid;

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

    public function findByName(string $name, string $localeId): ?MeldungKeyword
    {
        $q = $this->createQueryBuilder('mk');

        return $q->innerJoin('mk.translations', 'mkt')
            ->innerJoin('mkt.locale', 'l')
            ->andWhere($q->expr()->eq('mkt.name', ':name'))
            ->andWhere($q->expr()->eq('l.id', ':localeId'))
            ->setParameter('name', $name)
            ->setParameter('localeId', Uuid::fromString($localeId)->getBytes())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
