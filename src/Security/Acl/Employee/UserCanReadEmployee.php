<?php
namespace App\Security\Acl\Employee;

use App\Entity\Customer;
use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanReadEmployee implements AuthorizationInterface {

    public function __construct(private readonly Customer $customer){}
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            if ($user->getCompany() === $this->customer->getCompany()) {
                return true;
            }
        }

        if (in_array(IUserRole::ROLE_EMPLOYEE, $user->getRoles())) {
            if ($user->getCompany() === $this->customer->getCompany()) {
                return true;
            }
        }

        return false;
    }
}