<?php

namespace App\Security\Voter;

use App\Entity\Customer;
use App\Entity\Quote;
use App\Security\Acl\Quote\UserCanCreateQuote;
use App\Security\Acl\Quote\UserCanDeleteQuote;
use App\Security\Acl\Quote\UserCanEditQuote;
use App\Security\Acl\Quote\UserCanListQuote;
use App\Security\Acl\Quote\UserCanReadQuote;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class QuoteVoter extends Voter {
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

        if (!$subject instanceof Quote) {
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
        return (new UserCanListQuote())->isSatisfiedBy($user);
    }

    private function canCreate(UserInterface $user): bool
    {
        return (new UserCanCreateQuote())->isSatisfiedBy($user);
    }

    private function canRead(UserInterface $user, Quote $quote): bool
    {
        return (new UserCanReadQuote($quote))->isSatisfiedBy($user);
    }

    private function canEdit(UserInterface $user, Quote $quote): bool
    {
        return (new UserCanEditQuote($quote))->isSatisfiedBy($user);
    }

    private function canDelete(UserInterface $user, Quote $quote): bool
    {
        return (new UserCanDeleteQuote($quote))->isSatisfiedBy($user);
    }
}