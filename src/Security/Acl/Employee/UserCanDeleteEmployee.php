<?php
namespace App\Security\Acl\Employee;

use App\Entity\Customer;
use App\Entity\User;
use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanDeleteEmployee implements AuthorizationInterface {

    public function __construct(private readonly User $employee){}
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->employee);
        }

        return false;
    }

    private function hasSameCompany(UserInterface $user, User $employee): bool
    {
        return $user->getCompany() === $employee->getCompany();
    }
}