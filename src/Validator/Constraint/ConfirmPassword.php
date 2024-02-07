<?php

namespace App\Validator\Constraint;

use App\Validator\ConfirmPasswordValidator;
use App\Validator\CurrentPasswordValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ConfirmPassword extends Constraint
{
    public string $message = 'Les mots de passe ne correspondent pas.';
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
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy(): string
    {
        return ConfirmPasswordValidator::class;
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