<?php

namespace App\Repository;

use App\Entity\RegistrationContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RegistrationContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method RegistrationContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method RegistrationContent[]    findAll()
 * @method RegistrationContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistrationContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RegistrationContent::class);
    }

    // /**
    //  * @return RegistrationContent[] Returns an array of RegistrationContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RegistrationContent
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
