<?php

namespace App\Query\Quote;

use App\Entity\Quote;
use App\Service\Helper\SearchTermTransformerHelper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * This class is used to create a Doctrine query object that will be used to search for quotes.
 * The properties that are searched are:
 */
class FullSearchQuery extends ServiceEntityRepository
{
    const ALIAS = 'c';
    private string $searchTerm;
    private SearchTermTransformerHelper $searchTermTransformerService;

    public function __construct(
        ManagerRegistry $registry, 
        SearchTermTransformerHelper $searchTermTransformerService
    ) {
        parent::__construct($registry, Quote::class);
        $this->searchTermTransformerService = $searchTermTransformerService;
    }

    public function get(): Query
    {
        $query = $this->createQueryBuilder(self::ALIAS)
            ->select(self::ALIAS)
            ->where('TSMATCH(c.searchVector, TO_TSQUERY(:search)) = true')
            ->getQuery();

        return $query
            ->setParameter('search', $this->searchTerm);;
    }

    public function withTerm(string $searchTerm): self
    {
        $this->searchTerm = $this
            ->searchTermTransformerService
            ->withTerm($searchTerm)
            ->get();

        return $this;
    }
}