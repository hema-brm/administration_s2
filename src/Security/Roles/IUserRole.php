<?php

namespace App\Security\Roles;

interface IUserRole
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_COMPANY = 'ROLE_ENTREPRISE';
    const ROLE_EMPLOYEE = 'ROLE_EMPLOYEE';
    const ROLE_ACCOUNTANT = 'ROLE_COMPTABLE';
    const ROLE_USER = 'ROLE_USER';
}