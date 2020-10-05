<?php

namespace App\Repository;

use App\Entity\PreRegistration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PreRegistration|null find($id, $lockMode = null, $lockVersion = null)
 * @method PreRegistration|null findOneBy(array $criteria, array $orderBy = null)
 * @method PreRegistration[]    findAll()
 * @method PreRegistration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PreRegistrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PreRegistration::class);
    }

    // /**
    //  * @return PreRegistration[] Returns an array of PreRegistration objects
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
    public function findOneBySomeField($value): ?PreRegistration
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
