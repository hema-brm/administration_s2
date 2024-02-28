<?php

namespace App\Validator\Constraint;

use App\Validator\QuoteStatusValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class QuoteStatus extends Constraint
{
    public string $message = 'Le statut de devis "{{ value }}" n\'est pas valide.';
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
        return QuoteStatusValidator::class;
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