<?php

namespace App\Repository;

use App\Entity\Pageintro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pageintro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pageintro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pageintro[]    findAll()
 * @method Pageintro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageintroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pageintro::class);
    }

    // /**
    //  * @return Pageintro[] Returns an array of Pageintro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pageintro
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
