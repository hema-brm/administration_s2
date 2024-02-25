<?php

namespace App\Validator;

use App\Entity\Quote;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class QuoteStatusValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): bool
    {
        $availableQuoteStatus = [
            Quote::STATUS_DRAFT,
            Quote::STATUS_SENT,
            Quote::STATUS_ACCEPTED,
            Quote::STATUS_REFUSED,
        ];

        // value is an array, verify if each value item can be found in the available quote status
            if (!in_array($value, $availableQuoteStatus)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ value }}', $value)
                    ->addViolation();

                return false;
            }

        return true;
    }
}