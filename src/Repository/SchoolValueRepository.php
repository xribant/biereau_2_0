<?php

namespace App\Repository;

use App\Entity\SchoolValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SchoolValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchoolValue[]    findAll()
 * @method SchoolValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolValue::class);
    }

    // /**
    //  * @return SchoolValue[] Returns an array of SchoolValue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SchoolValue
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
