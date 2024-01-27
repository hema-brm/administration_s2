<?php

namespace App\Query\User;

use App\Query\Criteria;
use App\Query\Trait\ReduceAdminUserTrait;
use Doctrine\ORM\QueryBuilder;

class UserIsNotAdmin implements Criteria
{
    use ReduceAdminUserTrait;

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        return $this->reduceAdmin($builder);
    }
}