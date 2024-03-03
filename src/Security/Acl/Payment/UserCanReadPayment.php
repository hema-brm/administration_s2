<?php

namespace App\Security\Acl\Payment;

use App\Entity\Payment;
use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanReadPayment implements AuthorizationInterface
{

    public function __construct(private readonly Payment $payment)
    {
    }
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->payment);
        }

        if (in_array(IUserRole::ROLE_EMPLOYEE, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->payment);
        }

        return false;
    }

    private function hasSameCompany(UserInterface $user, Payment $payment): bool
    {
        return $user->getCompany() === $payment->getBill()->getCustomer()->getCompany();
    }
}
