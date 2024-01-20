<?php

namespace App\Validator\Constraint;

use App\Validator\RoleValidator;
use Symfony\Component\Validator\Constraint;

#[\Attribute]
class Role extends Constraint
{
    public string $message = 'The role "{{ value }}" is not valid.';
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
        return RoleValidator::class;
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