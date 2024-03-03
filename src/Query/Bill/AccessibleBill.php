<?php

namespace App\Query\Bill;

use App\Query\Criteria;
use App\Security\Roles\IUserRole;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\User\UserInterface;

class AccessibleBill implements Criteria
{
    private UserInterface $user;

    public function apply(QueryBuilder $builder): QueryBuilder
    {
        if (empty($this->user)) {
            throw new \LogicException('User is not set, call withUser() first.');
        }

        //Afficher tous les clients sir le User est Admin
        if (in_array(IUserRole::ROLE_ADMIN, $this->user->getRoles())) {
            return $builder;
        }

        // Sinon afficher que kes clients de la meme entreprise que le User
        (new BillOfCompany())
            ->withCompanyId($this->user->getCompany()->getId())
            ->apply($builder);

        return $builder;
    }

    public function withUser(UserInterface $user): self
    {
        $this->user = $user;
        return $this;
    }
}