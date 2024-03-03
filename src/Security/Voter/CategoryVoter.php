<?php

namespace App\Security\Voter;

use App\Entity\Category;
use App\Security\Roles\IUserRole;
use function PHPUnit\Framework\matches;
use App\Security\Acl\Category\UserCanEditCategory;
use App\Security\Acl\Category\UserCanListCategory;
use App\Security\Acl\Category\UserCanCreateCategory;
use App\Security\Acl\Category\UserCanDeleteCategory;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CategoryVoter extends Voter
{
    public const VIEW = 'view';
    public const CREATE = 'add';
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

        if (!$subject instanceof Category) {
            return false;
        }

        if (in_array($attribute, [
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
            self::EDIT => $this->canEdit($user, $subject),
            self::DELETE => $this->canDelete($user, $subject),
            default => false,
        };
    }

    private function canView(UserInterface $user): bool
    {
        return (new UserCanListCategory())->isSatisfiedBy($user);
    }

    private function canCreate(UserInterface $user): bool
    {
        return (new UserCanCreateCategory())->isSatisfiedBy($user);
    }

    private function canEdit(UserInterface $user, Category $category): bool
    {
        return (new UserCanEditCategory($category))->isSatisfiedBy($user);
    }

    private function canDelete(UserInterface $user, Category $category): bool
    {
        return (new UserCanDeleteCategory($category))->isSatisfiedBy($user);
    }
}