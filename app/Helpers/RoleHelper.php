<?php

namespace App\Helpers;

class RoleHelper
{
    public const ROLE_STUDENT = 1;
    public const ROLE_ADMIN = 2;

    public static function isAdmin(): bool
    {
        return \Auth::user()->roleId === self::ROLE_ADMIN;
    }

    public static function isStudent(): bool
    {
        return \Auth::user()->roleId === self::ROLE_STUDENT;
    }

}
