<?php

namespace App\Security\Voter;

use App\Entity\Customer;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @TODO:
 * 1. Admin can manage all customer
 * 2. Company manager can manage only his own customer
 */
class CustomerVoter extends Voter {
    public const MANAGE = 'manage';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $attribute == self::MANAGE;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        return match ($attribute) {
            self::MANAGE => $this->canManage($user),
            default => false,
        };
    }

    private function canManage(UserInterface $user): bool
    {
        return in_array(
            IUserRole::ROLE_ADMIN,
            $user->getRoles()
        );
    }
}