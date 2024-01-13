<?php

namespace App\Query\User\Employee;

use App\Entity\User;
use App\Query\Criteria;
use App\Query\Trait\ReduceAdminUserTrait;
use Doctrine\ORM\QueryBuilder;

class UserIsNotAdminQuery implements Criteria
{
    use ReduceAdminUserTrait;

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        return $this->reduceAdmin($builder);
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