<?php

namespace App\Query\Quote;

use App\Query\Criteria;
use App\Security\Roles\IUserRole;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\User\UserInterface;

class AccessibleQuote implements Criteria
{
    private UserInterface $user;

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        if (empty($this->user)) {
            throw new \LogicException('User is not set, call withUser() first.');
        }

        // if user is admin, return all customers
        if (in_array(IUserRole::ROLE_ADMIN, $this->user->getRoles())) {
            return $builder;
        }

        // otherwise, return only customers from the same company
        (new QuoteOfCompany())
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