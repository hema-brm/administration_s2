<?php

namespace App\Query\Customer;

use App\Query\Trait\PaginatorTrait;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\SecurityBundle\Security;

class AccessibleCustomerForConnectedUserQuery extends ServiceCustomerRepository
{
    use PaginatorTrait;
    private Security $security;

    public function __construct(
        ManagerRegistry $registry,
        Security $security
    ) {
        parent::__construct($registry);
        $this->security = $security;
    }

    public function get(): Query
    {
        $query = $this->createQueryBuilder('c');

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return $query->getQuery();
        }

        return $query
            ->where('c.company = :company')
            ->setParameter('company', $this->security->getUser()->getCompany())
            ->getQuery();
    }
}