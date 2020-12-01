<?php

namespace App\Repository;

use App\Entity\SubArticle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SubArticle|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubArticle|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubArticle[]    findAll()
 * @method SubArticle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubArticle::class);
    }

    // /**
    //  * @return SubArticle[] Returns an array of SubArticle objects
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
    public function findOneBySomeField($value): ?SubArticle
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
