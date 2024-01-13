<?php

namespace App\Query\User\Employee;

use App\Entity\User;
use App\Query\Criteria;
use App\Security\Roles\IUserRole;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\User\UserInterface;

class AccessibleEmployeeQuery implements Criteria
{
    private UserInterface $user;

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        if (empty($this->user)) {
            throw new \LogicException('User is not set, call withUser() first.');
        }

        (new UserIsNotAdminQuery())->apply($builder);

        // if user is admin, return all employees
        if (in_array(IUserRole::ROLE_ADMIN, $this->user->getRoles())) {
            return $builder;
        }

        return $builder
            ->andWhere('u.company = :company')
            ->andWhere('CAST(u.roles AS text) LIKE :role')
            ->setParameter('role',"%" . IUserRole::ROLE_EMPLOYEE . "%")
            ->setParameter('company', $this->security->getUser()->getCompany());
    }

    public function withUser(UserInterface $user): self
    {
        $this->user = $user;
        return $this;
    }

    public static function getEntityAlias(): string
    {
        return 'u';
    }

    public static function getEntityClass(): string
    {
        return User::class;
    }
}