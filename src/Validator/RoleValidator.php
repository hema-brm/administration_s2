<?php

namespace App\Validator;

use App\Security\Roles\IUserRole;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RoleValidator extends ConstraintValidator
{

    public function __construct(
        private readonly Security $security,
    )
    {
    }

    public function validate($value, Constraint $constraint): bool
    {
        if ($this->security->isGranted(IUserRole::ROLE_ADMIN)) {
            return true;
        }

        if (empty($value)) {
            return false;
        }

        $availableRoles = [
            IUserRole::ROLE_ADMIN,
            IUserRole::ROLE_COMPANY,
            IUserRole::ROLE_ACCOUNTANT,
            IUserRole::ROLE_EMPLOYEE,
        ];

        // value is an array, verify if each value item can be found in the available roles
        foreach ($value as $role) {
            if (!in_array($role, $availableRoles)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', implode(', ', $value))
                    ->addViolation();

                return false;
            }
        }

        return true;
    }
}