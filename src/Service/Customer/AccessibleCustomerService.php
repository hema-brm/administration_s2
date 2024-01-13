<?php

namespace App\Service\Customer;

use App\Query\Customer\AccessibleCustomerQuery;
use App\Query\Trait\PaginatorTrait;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

class AccessibleCustomerService {
    use PaginatorTrait;

    public function __construct(
        private readonly Security $security,
        private readonly AccessibleCustomerQuery $customersQuery,
        private readonly EntityManagerInterface $manager
    ) {}

    public function findAll(int $page, int $limit): Paginator
    {
        $queryBuilder = $this->manager
            ->createQueryBuilder()
            ->select(AccessibleCustomerQuery::getEntityAlias())
            ->from(AccessibleCustomerQuery::getEntityClass(), AccessibleCustomerQuery::getEntityAlias())
        ;

        $query = $this->customersQuery
            ->withUser($this->security->getUser())
            ->apply($queryBuilder)
            ->getQuery();

        return new Paginator($this->decoratePaginator($query, $page, $limit));
    }
}