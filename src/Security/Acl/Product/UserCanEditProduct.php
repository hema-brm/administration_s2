<?php
namespace App\Security\Acl\Product;

use App\Entity\Product;
use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanEditProduct implements AuthorizationInterface {

    public function __construct(private readonly Product $product){}
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->product);
        }

        return false;
    }

    private function hasSameCompany(UserInterface $user, Product $product): bool
    {
        return $user->getCompany() === $product->getCompany();
    }
}