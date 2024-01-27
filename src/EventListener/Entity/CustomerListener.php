<?php

namespace App\EventListener\Entity;

use App\Entity\Customer;
use App\Service\Customer\CustomerCompanyService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, method: 'set', entity: Customer::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'set', entity: Customer::class)]
#[AsEntityListener(event: Events::preFlush, method: 'set', entity: Customer::class)]
class CustomerListener
{
    public function __construct(
        private readonly CustomerCompanyService $customerCompanyService,
    ){}

    public function set(Customer $customer): void
    {
        $this->customerCompanyService->ensureCompany($customer);
    }
}