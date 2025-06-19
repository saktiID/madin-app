<?php

namespace App\Services;

use App\Models\User;
use App\Models\Ustadz;

class Validator
{
    public static function validate_email(string $email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    public static function is_unique_email(string $email): bool
    {
        return !User::where('email', $email)->exists();
    }

    public static function validate_nik(string $nik): bool
    {
        return preg_match('/^\d{16}$/', $nik) === 1;
    }

    public static function is_unique_nik(string $nik): bool
    {
        return !Ustadz::where('nik', $nik)->exists();
    }

    public static function validate_telp(string $number): bool
    {
        return preg_match('/^0\d{9,13}$/', $number) === 1;
    }
}
