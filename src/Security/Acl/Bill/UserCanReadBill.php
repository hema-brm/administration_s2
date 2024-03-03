<?php
namespace App\Security\Acl\Bill;

use App\Entity\Bill;
use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanReadBill implements AuthorizationInterface {

    public function __construct(private readonly Bill $bill){}
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->bill);
        }

        if (in_array(IUserRole::ROLE_EMPLOYEE, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->bill);
        }

        if (in_array(IUserRole::ROLE_ACCOUNTANT, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->bill);
        }

        return false;
    }

    private function hasSameCompany(UserInterface $user, Bill $bill): bool
    {   
        return $user->getCompany() === $bill->getCustomer()->getCompany();
    }
}