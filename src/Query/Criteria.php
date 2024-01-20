<?php

namespace App\Query;

use Doctrine\ORM\QueryBuilder;

interface Criteria
{
    public function apply(QueryBuilder $builder): QueryBuilder;
}
