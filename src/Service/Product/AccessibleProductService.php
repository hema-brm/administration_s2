<?php

namespace App\Service\Product;

use App\Query\Customer\AccessibleCustomer;
use App\Query\Product\AccessibleProduct;
use App\Query\Trait\PaginatorTrait;
use App\Repository\CustomerRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bundle\SecurityBundle\Security;

class AccessibleProductService {
    use PaginatorTrait;

    public function __construct(
        private readonly Security          $security,
        private readonly AccessibleProduct $productQuery,
        private readonly ProductRepository $productRepository,
    ) {}

    public function findAll(): QueryBuilder
    {
        $queryBuilder = $this->productRepository->createQueryBuilder('p');

        return $this->productQuery
            ->withUser($this->security->getUser())
            ->apply($queryBuilder);
        ;
    }
}