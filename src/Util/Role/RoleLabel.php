<?php

namespace App\Util\Role;

use App\Security\Roles\IUserRole;

class RoleLabel {
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
            self::ROLE_ADMIN => 'Administrateur',
            self::ROLE_EMPLOYEE => 'Employé',
            self::ROLE_COMPANY => 'Gérant',
            self::ROLE_ACCOUNTANT => 'Comptable',
            default => '',
        };
    }
}