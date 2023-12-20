<?php

namespace App\Security\Voter;

use App\Entity\Product;
use App\Security\Roles\IUserRole;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use function PHPUnit\Framework\matches;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProductVoter extends Voter
{
    public const EDIT = 'edit';
    public const DELETE = 'delete';
    public const VIEW = 'view';

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, [self::VIEW,self::EDIT, self::DELETE])
            && $subject instanceof \App\Entity\Product;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->canShow($subject, $user);
            case self::EDIT:
            case self::DELETE:
                return $this->canModify($subject, $user);
            default:
                return false;
        }
    }

    private function canShow(Product $product, UserInterface $user): bool
    {//role admin, entreprise, employee
        $permission = in_array(IUserRole::ROLE_ADMIN, $user->getRoles()) or ($product->getCompanyId() === $user->getCompany());
        
        if(!$permission){
            throw new AccessDeniedException('Vous n\'avez pas la permission d\'accéder à ce produit.');
        }
        return $permission;
    }

    private function canModify(Product $product, UserInterface $user): bool
    {   $permission = in_array(IUserRole::ROLE_ADMIN, $user->getRoles()) or ( in_array(IUserRole::ROLE_COMPANY, $user->getRoles()) and ($product->getCompanyId() === $user->getCompany()) );
        if(!$permission){
            throw new AccessDeniedException('Vous n\'avez pas la permission de modifier ou supprimer ce produit.');
        }
        return $permission;
    }
}