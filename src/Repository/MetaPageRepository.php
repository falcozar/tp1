<?php

namespace App\Repository;

use App\Entity\MetaPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MetaPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetaPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetaPage[]    findAll()
 * @method MetaPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetaPage::class);
    }

    // /**
    //  * @return MetaPage[] Returns an array of MetaPage objects
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
    public function findOneBySomeField($value): ?MetaPage
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
