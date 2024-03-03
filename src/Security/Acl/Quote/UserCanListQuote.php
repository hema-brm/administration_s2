<?php
namespace App\Security\Acl\Quote;

use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanListQuote implements AuthorizationInterface {
    public function isSatisfiedBy(UserInterface $user): bool
    {
        $authorizedRoles = [
            IUserRole::ROLE_ADMIN,
            IUserRole::ROLE_COMPANY,
            IUserRole::ROLE_EMPLOYEE,
        ];

        foreach ($authorizedRoles as $authorizedRole) {
            if (in_array($authorizedRole, $user->getRoles())) {
                return true;
            }
        }

        return false;
    }
}