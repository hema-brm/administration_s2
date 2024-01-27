<?php
namespace App\Security\Acl\Employee;

use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanListEmployee implements AuthorizationInterface {
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_EMPLOYEE, $user->getRoles())) {
            return true;
        }

        return false;
    }
}