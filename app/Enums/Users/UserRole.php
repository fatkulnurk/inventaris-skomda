<?php

namespace App\Enums\Users;

enum UserRole: string
{
    case ADMIN = 'admin';
    CASE TEACHER = 'teacher';
    CASE STUDENT = 'student';

    public static function getRandom(): UserRole
    {
        return self::cases()[array_rand(self::cases())];
    }
}
