<?php

namespace App\Service\Customer;

use App\Query\Customer\AccessibleCustomer;
use App\Query\Trait\PaginatorTrait;
use App\Repository\CustomerRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\SecurityBundle\Security;

class AccessibleCustomerService {
    use PaginatorTrait;

    public function __construct(
        private readonly Security           $security,
        private readonly AccessibleCustomer $customersQuery,
        private readonly CustomerRepository $customerRepository,
    ) {}

    public function getFindAllQuery(): QueryBuilder
    {
        $queryBuilder = $this->customerRepository->createQueryBuilder('c');

        return $this->customersQuery
            ->withUser($this->security->getUser())
            ->apply($queryBuilder);
        ;
    }

    public function findAllOverPages(int $page, int $limit): Paginator
    {
        $queryBuilder = $this->customerRepository->createQueryBuilder('c');

        $query = $this->customersQuery
            ->withUser($this->security->getUser())
            ->apply($queryBuilder)
            ->getQuery();

        return new Paginator($this->decoratePaginator($query, $page, $limit));
    }
}