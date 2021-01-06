<?php

namespace App\Repository;

use App\Entity\ContactSub;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContactSub|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactSub|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactSub[]    findAll()
 * @method ContactSub[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactSubRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactSub::class);
    }

    public function findAllRegistrantByCreationDate(){
        return $this->createQueryBuilder('p')
            ->orderBy('p.created_at', 'desc')
            ->addOrderBy('p.created_at', 'desc')
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return ContactSub[] Returns an array of ContactSub objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactSub
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
