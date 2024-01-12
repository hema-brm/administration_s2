<?php

namespace App\Query\Customer;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ServiceCustomerRepository extends ServiceEntityRepository {
    public function __construct(
        ManagerRegistry $registry
    ) {
        parent::__construct($registry, Customer::class);
    }
}