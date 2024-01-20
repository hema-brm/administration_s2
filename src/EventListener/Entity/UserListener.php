<?php

namespace App\EventListener\Entity;

use App\Entity\User;
use App\Service\User\UserCompanyService;
use App\Service\User\UserPasswordService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, method: 'set', entity: User::class)]
#[AsEntityListener(event: Events::preUpdate, method: 'set', entity: User::class)]
class UserListener
{
    public function __construct(
        private readonly UserCompanyService $userCompanyService,
        private readonly UserPasswordService $userPasswordService
    ){}

    public function set(User $user): void
    {
        $this->userCompanyService->ensureCompany($user);
        $this->userPasswordService->ensurePassword($user);
    }
}