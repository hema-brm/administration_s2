<?php

namespace App\Query\User;

use App\Query\Criteria;
use Doctrine\ORM\QueryBuilder;

class UserOfCompany implements Criteria
{
    private string $companyId;

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        if (empty($this->companyId)) {
            throw new \LogicException('Company id is not set, call withCompanyId() first.');
        }

        $uniqueId = uniqid();
        return $builder
            ->andWhere("u.company = :company_$uniqueId")
            ->setParameter("company_$uniqueId", $this->companyId);
    }

    public function withCompanyId(string $companyId): self
    {
        $this->companyId = $companyId;
        return $this;
    }
}