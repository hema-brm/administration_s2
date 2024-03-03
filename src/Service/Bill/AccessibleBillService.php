<?php

namespace App\Service\Bill;

use App\Query\Bill\AccessibleBill;
use App\Query\Trait\PaginatorTrait;
use App\Repository\BillRepository;
use Symfony\Bundle\SecurityBundle\Security;

class AccessibleBillService {
    use PaginatorTrait;

    public function __construct(
        private readonly Security           $security,
        private readonly AccessibleBill     $billQuery,
        private readonly BillRepository     $billRepository,
    ) {}

    public function findAll(): array
    {
        $queryBuilder = $this->billRepository->createQueryBuilder('b');

        return $this->billQuery
            ->withUser($this->security->getUser())
            ->apply($queryBuilder)
            ->getQuery()
            ->getResult();
    }
}