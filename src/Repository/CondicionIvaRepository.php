<?php

namespace App\Repository;

use App\Entity\CondicionIva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CondicionIva>
 *
 * @method CondicionIva|null find($id, $lockMode = null, $lockVersion = null)
 * @method CondicionIva|null findOneBy(array $criteria, array $orderBy = null)
 * @method CondicionIva[]    findAll()
 * @method CondicionIva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CondicionIvaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CondicionIva::class);
    }

//    /**
//     * @return CondicionIva[] Returns an array of CondicionIva objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CondicionIva
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
