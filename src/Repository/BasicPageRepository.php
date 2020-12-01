<?php

namespace App\Repository;

use App\Entity\BasicPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BasicPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasicPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasicPage[]    findAll()
 * @method BasicPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasicPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BasicPage::class);
    }

    /**
     * @return BasicPage
     */
    public function findFirst()
    {
        return $this->createQueryBuilder('b')
        ->orderBy('b.id', 'ASC')
            ->setFirstResult(0)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
    ;
    }

    // /**
    //  * @return BasicPage[] Returns an array of BasicPage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BasicPage
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
