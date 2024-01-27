<?php

namespace App\Service\User;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;

class UserCompanyService
{
    public function __construct(
        private readonly Security $security
    )
    {}

    public function ensureCompany(User $user): void
    {
        // Admin users should not have company
        if ($user->isAdmin()) {
            return;
        }

        if (!$user->hasCompany()) {
            $user->setCompany($this->security->getUser()->getCompany());
        }
    }
}