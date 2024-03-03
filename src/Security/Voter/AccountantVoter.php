<?php

namespace App\Security\Voter;

use App\Entity\Accountant;
use App\Security\Acl\Accountant\UserCanCreateAccountant;
use App\Security\Acl\Accountant\UserCanEditAccountant;
use App\Security\Acl\Accountant\UserCanListAccountant;
use App\Security\Acl\Accountant\UserCanDeleteAccountant;
use App\Security\Acl\Accountant\UserCanReadAccountant;
use Attribute;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class AccountantVoter extends Voter
{
    public const VIEW = 'view';


    protected function supports(string $attribute, mixed $subject): bool
    {
        if (in_array($attribute, [
            self::VIEW,
        ])) {
            return true;
        }

        return false;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }
        return match ($attribute) {
            self::VIEW => $this->canView($user),
            default => false,
        };
    }

    private function canView(UserInterface $user): bool
    {
        return (new UserCanListAccountant())->isSatisfiedBy($user);
    }
}
