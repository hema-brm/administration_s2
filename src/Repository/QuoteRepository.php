<?php

namespace App\Repository;

use App\Entity\Quote;
use App\Query\Trait\PaginatorTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Query\Quote\FullSearchQuery;
use Doctrine\ORM\Tools\Pagination\Paginator;



/**
 * @extends ServiceEntityRepository<Quote>
 *
 * @method Quote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Quote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Quote[]    findAll()
 * @method Quote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteRepository extends ServiceEntityRepository
{
    use PaginatorTrait;

    private FullSearchQuery $fullSearchQuery;

    public function __construct(ManagerRegistry $registry,FullSearchQuery $fullSearchQuery) {
        parent::__construct($registry, Quote::class);
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
