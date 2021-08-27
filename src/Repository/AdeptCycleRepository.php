<?php

namespace App\Repository;

use App\Entity\AdeptCycle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdeptCycle|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdeptCycle|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdeptCycle[]    findAll()
 * @method AdeptCycle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdeptCycleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdeptCycle::class);
    }

    // /**
    //  * @return AdeptCycle[] Returns an array of AdeptCycle objects
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
    public function findOneBySomeField($value): ?AdeptCycle
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
