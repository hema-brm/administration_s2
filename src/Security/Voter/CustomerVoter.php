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
    public const WRITE = 'write';
    public const DELETE = 'delete';
    public const READ = 'read';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array(
            $attribute,
            [
                self::READ,
                self::WRITE,
                self::DELETE
            ]
        ) && $subject instanceof Customer;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        return match ($attribute) {
            self::READ => $this->canShow($subject, $user),
            self::WRITE, self::DELETE => $this->canModify($subject, $user),
            default => false,
        };
    }

    private function canShow(Customer $customer, UserInterface $user): bool
    {
        return in_array(
            IUserRole::ROLE_ADMIN,
            $user->getRoles()
        );
    }

    private function canModify(Customer $customer, UserInterface $user): bool
    {
        return in_array(
            IUserRole::ROLE_ADMIN,
            $user->getRoles()
        );
    }
}