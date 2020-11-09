<?php

namespace App\Repository;

use App\Entity\SiteHomePageBanner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SiteHomePageBanner|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteHomePageBanner|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteHomePageBanner[]    findAll()
 * @method SiteHomePageBanner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteHomePageBannerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiteHomePageBanner::class);
    }

    // /**
    //  * @return SiteHomePageBanner[] Returns an array of SiteHomePageBanner objects
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
    public function findOneBySomeField($value): ?SiteHomePageBanner
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
