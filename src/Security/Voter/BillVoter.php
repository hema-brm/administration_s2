<?php

namespace App\Security\Voter;

use App\Entity\Bill;
use App\Security\Acl\Bill\UserCanEditBill;
use App\Security\Acl\Bill\UserCanListBill;
use App\Security\Acl\Bill\UserCanReadBill;
use App\Security\Acl\Bill\UserCanCreateBill;
use App\Security\Acl\Bill\UserCanDeleteBill;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class BillVoter extends Voter
{
    public const VIEW = 'view';
    public const CREATE = 'add';
    public const READ = 'read';
    public const EDIT = 'edit';
    public const DELETE = 'delete';

    protected function supports(string $attribute, mixed $subject): bool
    {
        if (in_array($attribute, [
            self::VIEW,
            self::CREATE,
        ])) {
            return true;
        }

        if (!$subject instanceof Bill) {
            return false;
        }

        if (in_array($attribute, [
            self::READ,
            self::EDIT,
            self::DELETE,
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
            self::CREATE => $this->canCreate($user),
            self::READ => $this->canRead($user, $subject),
            self::EDIT => $this->canEdit($user, $subject),
            self::DELETE => $this->canDelete($user, $subject),
            default => false,
        };
    }

    private function canView(UserInterface $user): bool
    {
        return (new UserCanListBill())->isSatisfiedBy($user);
    }

    private function canCreate(UserInterface $user): bool
    {
        return (new UserCanCreateBill())->isSatisfiedBy($user);
    }

    private function canRead(UserInterface $user, Bill $bill): bool
    {
        return (new UserCanReadBill($bill))->isSatisfiedBy($user);
    }

    private function canEdit(UserInterface $user, Bill $bill): bool
    {
        return (new UserCanEditBill($bill))->isSatisfiedBy($user);
    }

    private function canDelete(UserInterface $user, Bill $bill): bool
    {
        return (new UserCanDeleteBill($bill))->isSatisfiedBy($user);
    }
}
