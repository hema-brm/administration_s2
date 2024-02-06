<?php
namespace App\Security\Acl\Employee;

use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanListEmployee implements AuthorizationInterface {
    public function isSatisfiedBy(UserInterface $user): bool
    {
        $authorizedRoles = [
            IUserRole::ROLE_ADMIN,
            IUserRole::ROLE_COMPANY,
            IUserRole::ROLE_EMPLOYEE,
            IUserRole::ROLE_ACCOUNTANT,
        ];

        foreach ($authorizedRoles as $authorizedRole) {
            if (in_array($authorizedRole, $user->getRoles())) {
                return true;
            }
        }

        return false;
    }
}