<?php

namespace App\Query\User;

use App\Query\Criteria;
use Doctrine\ORM\QueryBuilder;
use MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\Arr;
use MartinGeorgiev\Doctrine\ORM\Query\AST\Functions\AnyOnTheRightExistsOnTheLeft;

class UserWithRoles implements Criteria
{
    public function __construct(private readonly array $roles)
    {}

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        if (empty($this->roles)) {
            return $builder
                ->andWhere('1 = 0');
        }

        $uniqueId = uniqid();
        $builder->andWhere(
            "ANY_ON_RIGHT_EXISTS_ON_LEFT(CAST(u.roles AS jsonb), ARRAY(:role_$uniqueId)) = true",
        )->setParameter("role_$uniqueId", $this->roles);

        return $builder;
    }
}