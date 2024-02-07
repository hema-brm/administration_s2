<?php

namespace App\Validator;

use App\Security\Roles\IUserRole;
use App\Service\User\UserPasswordService;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConfirmPasswordValidator extends ConstraintValidator
{

    public function __construct(
        private readonly UserPasswordService $userPasswordService,
    )
    {
    }

    public function validate($value, Constraint $constraint): bool
    {
        if (empty($value)) {
            return false;
        }

        $plainPassword = $this->context->getRoot()->get($constraint->payload['field'])->getData();

        if (!$this->userPasswordService->verifyConfirmPassword($plainPassword, $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
            return false;
        }

        return true;
    }
}