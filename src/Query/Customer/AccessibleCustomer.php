<?php

namespace App\Query\Customer;

use App\Query\Criteria;
use App\Security\Roles\IUserRole;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\User\UserInterface;

class AccessibleCustomer implements Criteria
{
    private UserInterface $user;

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        if (empty($this->user)) {
            throw new \LogicException('User is not set, call withUser() first.');
        }

        if (in_array(IUserRole::ROLE_ADMIN, $this->user->getRoles())) {
            return $builder;
        }

        (new CustomerOfCompany())
            ->withCompanyId($this->user->getCompany()->getId())
            ->apply($builder);

        return $builder;
    }

    public function withUser(UserInterface $user): self
    {
        $this->user = $user;
        return $this;
    }
}