<?php

namespace App\EventListener\Entity;

use App\Entity\User;
use App\Service\User\UserCompanyService;
use App\Service\User\UserPasswordService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: User::class)]
#[AsEntityListener(event: Events::preUpdate, entity: User::class)]
class UserEntityListener
{
    public function __construct(
        private readonly UserCompanyService $userCompanyService,
        private readonly UserPasswordService $userPasswordService
    ){}

    public function prePersist(User $user): void
    {
        $this->userCompanyService->ensureCompany($user);
        $this->userPasswordService->ensurePassword($user);
    }

    public function preUpdate(User $user): void
    {
        $this->userCompanyService->ensureCompany($user);
        $this->userPasswordService->ensurePassword($user);
    }
}