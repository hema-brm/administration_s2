<?php
namespace App\Security\Acl;

use Symfony\Component\Security\Core\User\UserInterface;
interface AuthorizationInterface
{
    public function isSatisfiedBy(UserInterface $user): bool;
}