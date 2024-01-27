<?php

namespace App\Service\User\Employee;

use App\Query\Trait\PaginatorTrait;
use App\Query\User\Employee\AccessibleEmployee;
use App\Repository\UserRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\SecurityBundle\Security;

class AccessibleEmployeeService {
    use PaginatorTrait;

    public function __construct(
        private readonly Security           $security,
        private readonly AccessibleEmployee $employeesQuery,
        private readonly UserRepository     $userRepository,
    ) {}

    public function findAll(int $page = 1, int $limit = 10): Paginator
    {
        $loggedInUser = $this->userRepository->find(
            ($this->security->getUser())->getId()
        );

        $queryBuilder = $this->userRepository->createQueryBuilder('u');
        $query = $this
            ->employeesQuery
            ->withUser($loggedInUser)
            ->apply($queryBuilder)
            ->getQuery();

        return new Paginator($this->decoratePaginator($query, $page, $limit));
    }
}