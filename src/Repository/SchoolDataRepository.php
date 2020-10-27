<?php

namespace App\Repository;

use App\Entity\SchoolData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SchoolData|null find($id, $lockMode = null, $lockVersion = null)
 * @method SchoolData|null findOneBy(array $criteria, array $orderBy = null)
 * @method SchoolData[]    findAll()
 * @method SchoolData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SchoolDataRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SchoolData::class);
    }

    // /**
    //  * @return SchoolData[] Returns an array of School objects
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
    public function findOneBySomeField($value): ?SchoolData
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
