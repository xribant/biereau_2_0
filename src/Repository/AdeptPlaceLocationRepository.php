<?php

namespace App\Repository;

use App\Entity\AdeptPlaceLocation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AdeptPlaceLocation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdeptPlaceLocation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdeptPlaceLocation[]    findAll()
 * @method AdeptPlaceLocation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdeptPlaceLocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdeptPlaceLocation::class);
    }

    public function findReachedLocation(float $totalDistance)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT * FROM adept_place_location p 
                WHERE p.distance < :totalDistance
                ORDER BY p.distance DESC
                LIMIT 1
                ';

        $stmt = $conn->prepare($sql);
        $stmt->execute(['totalDistance' => $totalDistance]);

        return $stmt->fetchAllAssociative();
    }

    // /**
    //  * @return AdeptPlaceLocation[] Returns an array of AdeptPlaceLocation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdeptPlaceLocation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
