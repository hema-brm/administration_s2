<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Query\Customer\FullSearchQuery;
use App\Query\Trait\PaginatorTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Customer>
 *
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    use PaginatorTrait;

    private FullSearchQuery $fullSearchQuery;

    public function __construct(
        ManagerRegistry $registry,
        FullSearchQuery $fullSearchQuery    
    ) {
        parent::__construct($registry, Customer::class);
        $this->fullSearchQuery = $fullSearchQuery;
    }

    public function search(string $search, int $page = 1, int $limit = 10): Paginator 
    {
        $query = $this->fullSearchQuery
            ->withTerm($search)
            ->get();

        $this->decoratePaginator($query, $page, $limit);

        return new Paginator($query);
    }

    public function findAllWithPage(int $page = 1, int $limit = 10): Paginator
    {
        $query = $this
            ->createQueryBuilder('c')
            ->getQuery();

        $this->decoratePaginator($query, $page, $limit); 

        return new Paginator($query);
    }
}
