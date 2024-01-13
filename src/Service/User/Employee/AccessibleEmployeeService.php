<?php

namespace App\Service\User\Employee;

use App\Query\Trait\PaginatorTrait;
use App\Query\User\Employee\AccessibleEmployeeQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\SecurityBundle\Security;

class AccessibleEmployeeService {
    use PaginatorTrait;

    public function __construct(
        private readonly Security $security,
        private readonly AccessibleEmployeeQuery $employeesQuery,
        private readonly EntityManagerInterface $manager
    ) {}

    public function findAll(int $page = 1, int $limit = 10): Paginator
    {
        $queryBuilder = $this->manager
            ->createQueryBuilder()
            ->select(AccessibleEmployeeQuery::getEntityAlias())
            ->from(AccessibleEmployeeQuery::getEntityClass(), AccessibleEmployeeQuery::getEntityAlias())
        ;

        $query = $this
            ->employeesQuery
            ->withUser($this->security->getUser())
            ->apply($queryBuilder)
            ->getQuery();

        return new Paginator($this->decoratePaginator($query, $page, $limit));
    }
}