<?php

namespace App\Validator;

use App\Repository\UserRepository;
use App\Security\Roles\IUserRole;
use App\Service\User\UserPasswordService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CurrentPasswordValidator extends ConstraintValidator
{
    public function __construct(
        private readonly UserPasswordService $userPasswordService,
        private readonly Security $security,
    )
    {
    }

    public function validate($value, Constraint $constraint): bool
    {
        if (empty($value)) {
            return false;
        }

        // get form extra data
        $user = $this->context->getRoot()->getConfig()->getOption('user_before');

        if (!$this->userPasswordService->verifyCurrentPassword($user, $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();

            return false;
        }

        return true;
    }
}