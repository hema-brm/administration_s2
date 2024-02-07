<?php

namespace App\Service\User;

use App\Entity\User;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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

    public function verifyCurrentPassword(
        User|UserInterface   $user,
        string               $currentPassword): bool
    {
        return $this->hasher->isPasswordValid(
            $user,
            $currentPassword
        );
    }

    public function verifyNewPassword(
        User|UserInterface   $user,
        string               $newPassword): bool
    {
        return !$this->hasher->isPasswordValid(
            $user,
            $newPassword
        );
    }

    public function verifyConfirmPassword(
        string $plainPassword,
        string $confirmPassword): bool
    {
        return $plainPassword === $confirmPassword;
    }
}