<?php

namespace App\Security\Voter;

use App\Entity\Report;
use App\Security\Acl\Report\UserCanCreateReport;
use App\Security\Acl\Report\UserCanEditReport;
use App\Security\Acl\Report\UserCanListReport;
use App\Security\Acl\Report\UserCanDeleteReport;
use App\Security\Acl\Report\UserCanReadReport;
use Attribute;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class ReportVoter extends Voter
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
        return (new UserCanListReport())->isSatisfiedBy($user);
    }
}
