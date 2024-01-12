<?php

namespace App\Service\Customer;

use App\Query\Customer\AccessibleCustomerForConnectedUserQuery;
use App\Query\Trait\PaginatorTrait;
use App\Repository\CustomerRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\SecurityBundle\Security;

class CustomerService {
    use PaginatorTrait;
    private Security $security;
    private AccessibleCustomerForConnectedUserQuery $accessibleCustomerForConnectedUserQuery;

    public function __construct(
        Security $security,
        AccessibleCustomerForConnectedUserQuery $accessibleCustomerForConnectedUserQuery
    ) {
        $this->security = $security;
        $this->accessibleCustomerForConnectedUserQuery = $accessibleCustomerForConnectedUserQuery;
    }

    public function findAll(int $page, int $limit): Paginator
    {
        $query = $this->accessibleCustomerForConnectedUserQuery->get();
        return new Paginator($this->decoratePaginator($query, $page, $limit));
    }
}