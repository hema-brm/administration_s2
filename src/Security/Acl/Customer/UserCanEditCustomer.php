<?php
namespace App\Security\Acl\Customer;

use App\Entity\Customer;
use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanEditCustomer implements AuthorizationInterface {

    public function __construct(private readonly Customer $customer){}
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->customer);
        }

        if (in_array(IUserRole::ROLE_EMPLOYEE, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->customer);
        }

        return false;
    }

    private function hasSameCompany(UserInterface $user, Customer $customer): bool
    {
        return $user->getCompany() === $customer->getCompany();
    }
}