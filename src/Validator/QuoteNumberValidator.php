<?php

namespace App\Validator;

use App\Entity\Quote;
use App\Repository\QuoteRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class QuoteNumberValidator extends ConstraintValidator
{
    public function __construct(
        private readonly QuoteRepository $quoteRepository,
    )
    {
    }

    public function validate($value, Constraint $constraint): bool
    {
        $existingQuoteWithNumber = $this->quoteRepository->findQuoteByNumber($value);

        if ($existingQuoteWithNumber instanceof Quote)
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }

        return true;
    }
}