<?php

namespace App\Repository;

use App\Entity\AdeptCycle;
use App\Entity\AdeptCycleKm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdeptCycleKm|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdeptCycleKm|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdeptCycleKm[]    findAll()
 * @method AdeptCycleKm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdeptCycleKmRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdeptCycleKm::class);
    }

    public function findAllByCycle(AdeptCycle $adeptCycle) {
        return $this->createQueryBuilder('i')
            ->andWhere('i.Cycle = :adeptCycle')
            ->setParameter('adeptCycle', $adeptCycle)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return AdeptCycleKm[] Returns an array of AdeptCycleKm objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdeptCycleKm
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
