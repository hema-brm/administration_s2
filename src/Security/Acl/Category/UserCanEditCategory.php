<?php
namespace App\Security\Acl\Category;

use App\Entity\Category;
use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanEditCategory implements AuthorizationInterface {

    public function __construct(private readonly Category $category){}
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->category);
        }

        return false;
    }

    private function hasSameCompany(UserInterface $user, Category $category): bool
    {
        return $user->getCompany() === $category->getCompany();
    }
}