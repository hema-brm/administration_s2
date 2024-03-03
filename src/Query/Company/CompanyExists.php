<?php

namespace App\Query\Company;

use App\Entity\Company;
use App\Query\Criteria;
use Doctrine\ORM\QueryBuilder;

class CompanyExists implements Criteria
{
    public function apply(QueryBuilder $builder): QueryBuilder
    {
        return $builder->andWhere('c.id IS NOT NULL');
    }
}