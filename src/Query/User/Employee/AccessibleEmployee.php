<?php

namespace App\Query\User\Employee;

use App\Entity\User;
use App\Query\Criteria;
use App\Query\User\UserIsEmployee;
use App\Query\User\UserIsNotAdmin;
use App\Query\User\UserOfCompany;
use Doctrine\ORM\QueryBuilder;

class AccessibleEmployee implements Criteria
{
    private User $user;

    public function __construct(
        private readonly UserIsEmployee $userIsEmployee,
        private readonly UserOfCompany $userOfCompany
    )
    {}

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        if (empty($this->user)) {
            throw new \LogicException('User is not set, call withUser() first.');
        }

        (new UserIsNotAdmin())->apply($builder);
        $this->userIsEmployee->apply($builder);

        // if user is admin, return all employees
        if ($this->user->isAdmin()) {
            return $builder;
        }

        // get only employees of the company of the connected user
        $this->userIsEmployee->apply($builder);
        $this->userOfCompany->withCompanyId(
            $this->user->getCompany()->getId()
        )->apply($builder);

        return $builder;
    }

    public function withUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }
}