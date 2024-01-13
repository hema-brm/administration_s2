<?php

namespace App\Query\Trait;

use App\Security\Roles\IUserRole;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

trait ReduceAdminUserTrait {
    protected function reduceAdmin(QueryBuilder $query): QueryBuilder {
        $uniqParamName = 'role' . uniqid();
        return $query
            ->andWhere('CAST(u.roles AS text) NOT LIKE :' . $uniqParamName)
            ->setParameter($uniqParamName, "%" . IUserRole::ROLE_ADMIN . "%");
    }
}