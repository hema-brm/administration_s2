<?php

namespace App\Security\Acl\Accountant;

use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanListAccountant implements AuthorizationInterface
{
    public function isSatisfiedBy(UserInterface $user): bool
    {

        if (in_array(IUserRole::ROLE_ACCOUNTANT, $user->getRoles())) {
            return true;
        }


        return false;
    }
}
