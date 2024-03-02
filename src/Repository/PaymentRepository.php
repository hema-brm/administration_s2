<?php

namespace App\Repository;

use App\Entity\Payment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
        $paymentsData = $this->createQueryBuilder('payment')
            ->leftJoin('payment.bill', 'bill')
            ->where('payment.datePaiement IS NOT NULL')
            ->andWhere('payment.status = :status')
            ->setParameter('status', 'terminé')
            ->getQuery()
            ->getResult();

        $totals = [];
        foreach ($paymentsData as $payment) {
            $month = $payment->getDatePaiement()->format('m');
            $year = $payment->getDatePaiement()->format('Y');
            $totalPrice = 0;
            foreach ($payment->getBill()->getProductBills() as $productBill) {
                $totalPrice += $productBill->getRealTotal();
            }
            $totals[] = [
                'year' => $year,
                'month' => $month,
                'totalPrice' => $totalPrice
            ];
        }

        return $totals;
    }

    public function getTotalPriceSumByCategory(): array
    {
        $paymentsData = $this->createQueryBuilder('payment')
            ->leftJoin('payment.bill', 'bill')
            ->getQuery()
            ->getResult();

        $totals = [
            'En retard' => 0,
            'Terminé' => 0,
            'En cours' => 0,
        ];

        foreach ($paymentsData as $payment) {
            $status = ucfirst(strtolower($payment->getStatus()));
            if (array_key_exists($status, $totals)) {
                foreach ($payment->getBill()->getProductBills() as $productBill) {
                    $totals[$status] += $productBill->getRealTotal();
                }
            }
        }

        return $totals;
    }

    public function getTotalPriceSumByYear(): array
    {
        $paymentsData = $this->createQueryBuilder('payment')
            ->leftJoin('payment.bill', 'bill')
            ->where('payment.datePaiement IS NOT NULL')
            ->andWhere('payment.status = :status')
            ->setParameter('status', 'terminé')
            ->getQuery()
            ->getResult();

        $totals = [];
        foreach ($paymentsData as $payment) {
            $year = $payment->getDatePaiement()->format('Y');
            $totalPrice = 0;
            foreach ($payment->getBill()->getProductBills() as $productBill) {
                $totalPrice += $productBill->getRealTotal();
            }
            $totals[] = [
                'year' => $year,
                'totalPrice' => $totalPrice
            ];
        }

        return $totals;
    }
    public function findRecentPayments($limit): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.datePaiement', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
