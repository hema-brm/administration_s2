<?php

namespace App\Query\User;

use App\Query\Criteria;
use App\Security\Roles\IUserRole;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Role\RoleHierarchyInterface;

class UserIsEmployee implements Criteria
{
    public function __construct(private readonly RoleHierarchyInterface $roleHierarchy)
    {
    }

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        $roles = $this->roleHierarchy->getReachableRoleNames([IUserRole::ROLE_EMPLOYEE]);

        return (new UserWithRoles($roles))->apply($builder);
    }
}