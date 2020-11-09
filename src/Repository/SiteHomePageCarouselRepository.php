<?php

namespace App\Repository;

use App\Entity\SiteHomePageCarousel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SiteHomePageCarousel|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteHomePageCarousel|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteHomePageCarousel[]    findAll()
 * @method SiteHomePageCarousel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteHomePageCarouselRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SiteHomePageCarousel::class);
    }

    // /**
    //  * @return SiteHomePageCarousel[] Returns an array of SiteHomePageCarousel objects
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
    public function findOneBySomeField($value): ?SiteHomePageCarousel
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
