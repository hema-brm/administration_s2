<?php

namespace App\Repository;

use App\Entity\Bill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bill>
 *
 * @method Bill|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bill|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bill[]    findAll()
 * @method Bill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bill::class);
    }

    public function findByMonth(int $month, int $year): array
{
    $startDate = new \DateTime("$year-$month-01");
    $endDate = new \DateTime("$year-$month-01");
    $endDate->modify('last day of this month');

    return $this->createQueryBuilder('b')
        ->andWhere('b.CreationDate BETWEEN :start AND :end')
        ->setParameter('start', $startDate)
        ->setParameter('end', $endDate)
        ->getQuery()
        ->getResult();
}



public function findByYear(int $year): array
{
    $startDate = new \DateTime("$year-01-01");
    $endDate = new \DateTime("$year-12-31");

    return $this->createQueryBuilder('b')
        ->andWhere('b.CreationDate BETWEEN :start AND :end')
        ->setParameter('start', $startDate)
        ->setParameter('end', $endDate)
        ->getQuery()
        ->getResult();
}



//    /**
//     * @return Bill[] Returns an array of Bill objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bill
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
