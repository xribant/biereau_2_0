<?php

namespace App\Repository;

use App\Entity\SchoolEntryDate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SchoolEntryDate|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolEntryDate|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchoolEntryDate[]    findAll()
 * @method SchoolEntryDate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolEntryDateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolEntryDate::class);
    }

    // /**
    //  * @return SchoolEntryDate[] Returns an array of SchoolEntryDate objects
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
    public function findOneBySomeField($value): ?SchoolEntryDate
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
