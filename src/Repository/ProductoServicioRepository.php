<?php

namespace App\Repository;

use App\Entity\ProductoServicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductoServicio>
 *
 * @method ProductoServicio|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductoServicio|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductoServicio[]    findAll()
 * @method ProductoServicio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductoServicioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductoServicio::class);
    }

//    /**
//     * @return ProductoServicio[] Returns an array of ProductoServicio objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProductoServicio
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
