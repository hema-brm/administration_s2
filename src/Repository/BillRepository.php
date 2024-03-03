<?php

namespace App\Repository;

use App\Entity\Bill;
use App\Entity\Quote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;


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
    public function __construct(ManagerRegistry $registry, Security $security)
    {
        parent::__construct($registry, Bill::class);
$this->user = $security->getUser();
    }

    public function findLastBill(): ?Bill
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    /**
     * Find the most recent bills.
     *
     * @param int $limit The maximum number of recent bills to fetch
     * @return Bill[] The most recent bills
     */
    public function findRecentBills(int $limit = 5): array
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.billIssuanceDate', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findBillsByUserCompany()
    {
        return $this->createQueryBuilder('b')
            ->join('b.customer', 'c') // Rejoindre la relation customer de la facture
            ->where('c.company = :userCompany') // Filtrer par la société du client égale à la société de l'utilisateur
            ->setParameter('userCompany',  $this->user->getCompany())
            ->getQuery()
            ->getResult();
    }
}
