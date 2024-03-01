<?php

namespace App\Security\Voter;

use App\Entity\Customer;
use App\Security\Acl\Customer\UserCanCreateCustomer;
use App\Security\Acl\Customer\UserCanEditCustomer;
use App\Security\Acl\Customer\UserCanListCustomer;
use App\Security\Acl\Customer\UserCanDeleteCustomer;
use App\Security\Acl\Customer\UserCanReadCustomer;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomerVoter extends Voter {
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

        if (!$subject instanceof Customer) {
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
        return (new UserCanListCustomer())->isSatisfiedBy($user);
    }

    private function canCreate(UserInterface $user): bool
    {
        return (new UserCanCreateCustomer())->isSatisfiedBy($user);
    }

    private function canRead(UserInterface $user, Customer $customer): bool
    {
        return (new UserCanReadCustomer($customer))->isSatisfiedBy($user);
    }

    private function canEdit(UserInterface $user, Customer $customer): bool
    {
        return (new UserCanEditCustomer($customer))->isSatisfiedBy($user);
    }

    private function canDelete(UserInterface $user, Customer $customer): bool
    {
        return (new UserCanDeleteCustomer($customer))->isSatisfiedBy($user);
    }
}