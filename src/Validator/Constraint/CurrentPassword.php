<?php

namespace App\Validator\Constraint;

use App\Validator\CurrentPasswordValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class CurrentPassword extends Constraint
{
    public string $message = 'Le mot de passe actuel est incorrect.';
    public string $mode = 'strict';

    public function __construct(
        string $mode = null,
        string $message = null,
        array $groups = null,
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
        return CurrentPasswordValidator::class;
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