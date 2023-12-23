<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AsatidzValidatorServiceProvider extends ServiceProvider
{
    public static function validate($data)
    {
        $validator = Validator::make($data->all(), [
            'email' => 'required|unique:users',
            'password' => 'confirmed|min:5',
            'nik' => 'min:16',
            'telp' => 'min:10'
        ], [
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah ada yang menggunakan.',
            'password.confirmed' => 'Password tidak sama.',
            'password.min' => 'Password kurang dari 5 karakter.',
            'nik.min' => 'NIK kurang dari 16 digit.',
            'telp.min' => 'Nomor telepon kurang dari 10 digit.'
        ]);

        return $validator;
    }
}
