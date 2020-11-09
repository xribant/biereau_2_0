<?php

namespace App\Repository;

use App\Entity\SitePage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SitePage|null find($id, $lockMode = null, $lockVersion = null)
 * @method SitePage|null findOneBy(array $criteria, array $orderBy = null)
 * @method SitePage[]    findAll()
 * @method SitePage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SitePageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SitePage::class);
    }

    // /**
    //  * @return SitePage[] Returns an array of SitePage objects
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
    public function findOneBySomeField($value): ?SitePage
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
