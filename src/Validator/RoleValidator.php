<?php

namespace App\Validator;

use App\Security\Roles\IUserRole;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RoleValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): bool
    {
        if (empty($value)) {
            return false;
        }

        $availableRoles = [
            IUserRole::ROLE_ADMIN,
            IUserRole::ROLE_COMPANY,
            IUserRole::ROLE_ACCOUNTANT,
            IUserRole::ROLE_EMPLOYEE,
        ];

        if (!in_array($value, $availableRoles)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', implode(', ', $value))
                ->addViolation();

            return false;
        }

        return true;
    }
}