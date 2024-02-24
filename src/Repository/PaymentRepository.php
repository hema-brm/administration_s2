<?php

namespace App\Repository;

use Doctrine\ORM\Query\Expr;

use App\Entity\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Oro\ORM\Query\AST\Functions\String\DateFormat;

/**
 * @extends ServiceEntityRepository<Payment>
 *
 * @method Payment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Payment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Payment[]    findAll()
 * @method Payment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Payment::class);
    }
    public function getTotalPriceSumByMonth(): array
    {
        return $this->createQueryBuilder('payment')
            ->select("date_format(payment.datePaiement, '%Y') as year", "date_format(payment.datePaiement, '%m') as month", 'SUM(bill.totalPrice) as totalPrice')
            ->leftJoin('payment.bill', 'bill')
            ->where('payment.datePaiement IS NOT NULL')
            ->andWhere('payment.status = :status')
            ->setParameter('status', 'terminé')
            ->groupBy('month', 'year')
            ->getQuery()
            ->getResult();
    }

    public function getTotalPriceSumByYear(): array
    {
        return $this->createQueryBuilder('payment')
            ->select("DATE_FORMAT(payment.datePaiement, '%Y') as year", 'SUM(bill.totalPrice) as totalPrice')
            ->leftJoin('payment.bill', 'bill')
            ->where('payment.datePaiement IS NOT NULL')
            ->andWhere('payment.status = :status')
            ->setParameter('status', 'terminé')
            ->groupBy('year')
            ->getQuery()
            ->getResult();
    }
    public function getTotalPriceSumByCategory(): array
    {
        return $this->createQueryBuilder('payment')
            ->select('payment.status as category', 'SUM(bill.totalPrice) as totalPrice')
            ->leftJoin('payment.bill', 'bill')
            ->where('payment.datePaiement IS NOT NULL')
            ->groupBy('category')
            ->getQuery()
            ->getResult();
    }
}
