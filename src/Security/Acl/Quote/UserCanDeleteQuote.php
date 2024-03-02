<?php
namespace App\Security\Acl\Quote;

use App\Entity\Customer;
use App\Entity\Quote;
use App\Security\Acl\AuthorizationInterface;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\User\UserInterface;

class UserCanDeleteQuote implements AuthorizationInterface {

    public function __construct(private readonly Quote $quote){}
    public function isSatisfiedBy(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->quote);
        }

        if (in_array(IUserRole::ROLE_EMPLOYEE, $user->getRoles())) {
            return $this->hasSameCompany($user, $this->quote);
        }

        return false;
    }

    private function hasSameCompany(UserInterface $user, Quote $quote): bool
    {
        return $user->getCompany() === $quote->getCustomer()->getCompany();
    }
}