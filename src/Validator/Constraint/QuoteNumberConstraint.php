<?php

namespace App\Validator\Constraint;

use App\Validator\QuoteNumberValidator;
use App\Validator\QuoteStatusValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class QuoteNumberConstraint extends Constraint
{
    public string $message = 'Le numéro de devis "{{ value }}" est déjà utilisé.';
    public string $mode = 'strict';

    public function __construct(
        string $mode = null,
        string $message = null,
        array  $groups = null,
               $payload = null
    )
    {
        parent::__construct([], $groups, $payload);

        $this->mode = $mode ?? $this->mode;
        $this->message = $message ?? $this->message;
    }

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }

    public function validatedBy(): string
    {
        return QuoteNumberValidator::class;
    }

    public function getRequiredOptions(): array
    {
        return [];
    }

    public function getDefaultOption(): string
    {
        return '';
    }
}