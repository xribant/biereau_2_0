<?php

namespace App\Repository;

use App\Entity\StaffGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StaffGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method StaffGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method StaffGroup[]    findAll()
 * @method StaffGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaffGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StaffGroup::class);
    }

    // /**
    //  * @return StaffGroup[] Returns an array of StaffGroup objects
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
    public function findOneBySomeField($value): ?StaffGroup
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
