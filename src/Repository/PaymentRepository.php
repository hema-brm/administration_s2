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

    public function findLateInThreeDaysBills()
    {
        return $this->createQueryBuilder('p')
            ->where('p.dateEcheance = :threeDaysLater')
            ->setParameter('threeDaysLater', new \DateTime('+3 days')) // Par exemple, considérer les factures dont le paiement est en retard de plus de 30 jours
            ->getQuery()
            ->getResult();
    }

    public function findDeadlineBills()
    {
        return $this->createQueryBuilder('p')
            ->where('p.dateEcheance = :currentDate')
            ->setParameter('currentDate', new \DateTime()) // Par exemple, considérer les factures dont le paiement est en retard de plus de 30 jours
            ->getQuery()
            ->getResult();
    }

    public function findLateBills()
    {
        return $this->createQueryBuilder('p')
            ->where('p.dateEcheance < :currentDate')
            ->setParameter('currentDate', new \DateTime()) // Par exemple, considérer les factures dont le paiement est en retard de plus de 30 jours
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Payment[] Returns an array of Payment objects
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

//    public function findOneBySomeField($value): ?Payment
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
