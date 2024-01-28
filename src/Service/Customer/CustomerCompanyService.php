<?php

namespace App\Service\Customer;

use App\Entity\Customer;
use App\Entity\User;
use App\Security\Roles\IUserRole;
use Symfony\Bundle\SecurityBundle\Security;

class CustomerCompanyService
{
    public function __construct(
        private readonly Security $security
    )
    {}

    public function ensureCompany(Customer $customer): void
    {
        if (empty($this->security->getUser())) {
            return;
        }

        $currentUserCompany = $this->security->getUser()->getCompany();
        if (!$customer->hasCompany()) {
            $customer->setCompany($currentUserCompany);
        }
    }
}