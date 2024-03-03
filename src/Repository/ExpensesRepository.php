<?php

namespace App\Repository;

use App\Entity\Expenses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Expenses>
 *
 * @method Expenses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expenses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expenses[]    findAll()
 * @method Expenses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpensesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expenses::class);
    }

    public function findByFilters($selectedMonth, $selectedYear)
    {
        $query = $this->createQueryBuilder('e');

        if ($selectedMonth) {
            $query->andWhere('e.date >= :startOfMonth AND e.date < :startOfNextMonth')
                  ->setParameter('startOfMonth', new \DateTime($selectedYear . '-' . $selectedMonth . '-01'))
                  ->setParameter('startOfNextMonth', new \DateTime($selectedYear . '-' . ($selectedMonth + 1) . '-01'));
        }

        if ($selectedYear) {
            $query->andWhere('e.date >= :startOfYear AND e.date < :startOfNextYear')
                  ->setParameter('startOfYear', new \DateTime($selectedYear . '-01-01'))
                  ->setParameter('startOfNextYear', new \DateTime(($selectedYear + 1) . '-01-01'));
        }

        return $query->getQuery()->getResult();
    }

}
