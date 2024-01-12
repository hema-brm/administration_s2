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
    public const LIST = 'list';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return $attribute == self::LIST;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        return match ($attribute) {
            self::LIST => $this->canList($user),
            default => false,
        };
    }

    private function canList(UserInterface $user): bool
    {
        if (in_array(IUserRole::ROLE_ADMIN, $user->getRoles())) {
            return true;
        }

        if (in_array(IUserRole::ROLE_COMPANY, $user->getRoles())) {
            return true;
        }

        return false;
    }
}