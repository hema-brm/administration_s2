<?php

namespace App\Service\User;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserPasswordService
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {}

    public function ensurePassword(User $user): void
    {
        $user->setPassword(
            $this->hasher->hashPassword(
                $user,
                $user->getPassword()
            )
        );
    }
}