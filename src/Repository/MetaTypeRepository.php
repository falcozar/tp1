<?php

namespace App\Repository;

use App\Entity\MetaType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MetaType|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetaType|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetaType[]    findAll()
 * @method MetaType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetaType::class);
    }

    // /**
    //  * @return MetaType[] Returns an array of MetaType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MetaType
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
