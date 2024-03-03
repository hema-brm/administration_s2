<?php

namespace App\Service\Quote;

use App\Query\Quote\AccessibleQuote;
use App\Query\Trait\PaginatorTrait;
use App\Repository\QuoteRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\SecurityBundle\Security;

class AccessibleQuoteService {
    use PaginatorTrait;

    public function __construct(
        private readonly Security        $security,
        private readonly AccessibleQuote $quoteQuery,
        private readonly QuoteRepository $quoteRepository,
    ) {}

    public function findAll(): array
    {
        $queryBuilder = $this->quoteRepository->createQueryBuilder('q');

        return $this->quoteQuery
            ->withUser($this->security->getUser())
            ->apply($queryBuilder)
            ->getQuery()
            ->getResult();
    }

    public function findAllOverPages(int $page, int $limit): Paginator
    {
        $queryBuilder = $this->quoteRepository->createQueryBuilder('q');

        $query = $this->quoteQuery
            ->withUser($this->security->getUser())
            ->apply($queryBuilder)
            ->getQuery();

        return new Paginator($this->decoratePaginator($query, $page, $limit));
    }
}