<?php

namespace App\Repository;

use App\Entity\NavMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NavMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method NavMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method NavMenu[]    findAll()
 * @method NavMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NavMenu::class);
    }

    // /**
    //  * @return NavMenu[] Returns an array of NavMenu objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NavMenu
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
