<?php

namespace App\Repository;

use App\Entity\Vehicul;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Vehicul>
 *
 * @method Vehicul|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vehicul|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vehicul[]    findAll()
 * @method Vehicul[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehiculRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehicul::class);
    }

//    /**
//     * @return Vehicul[] Returns an array of Vehicul objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Vehicul
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
