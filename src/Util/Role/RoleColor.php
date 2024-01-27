<?php

namespace App\Util\Role;

use App\Security\Roles\IUserRole;

class RoleColor {
    public const ROLE_ADMIN = IUserRole::ROLE_ADMIN;
    public const ROLE_COMPANY = IUserRole::ROLE_COMPANY;
    public const ROLE_ACCOUNTANT = IUserRole::ROLE_ACCOUNTANT;
    public const ROLE_EMPLOYEE = IUserRole::ROLE_EMPLOYEE;
    public const ROLE_USER = IUserRole::ROLE_USER;

    private string $role;

    public function __construct(string $role) {
        $this->role = $role;
    }

    public function get(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => 'danger',
            self::ROLE_EMPLOYEE => 'primary',
            self::ROLE_COMPANY => 'warning',
            self::ROLE_ACCOUNTANT => 'info',
            default => 'default',
        };
    }
}