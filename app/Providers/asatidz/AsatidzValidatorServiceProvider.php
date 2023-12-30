<?php

namespace App\Providers\asatidz;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AsatidzValidatorServiceProvider extends ServiceProvider
{
    public static function validate($data)
    {
        $validator = Validator::make($data->all(), [
            'email' => 'required|unique:users',
            'password' => 'confirmed|min:5',
            'nik' => 'min:16|max:16|unique:pengajars',
            'telp' => 'min:10'
        ], [
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah ada yang menggunakan.',
            'password.confirmed' => 'Password tidak sama.',
            'password.min' => 'Password kurang dari 5 karakter.',
            'nik.max' => 'NIK lebih dari 16 digit.',
            'nik.min' => 'NIK kurang dari 16 digit.',
            'nik.unique' => 'NIK sudah ada yang menggunakan.',
            'telp.min' => 'Nomor telepon kurang dari 10 digit.'
        ]);

        return $validator;
    }

    public static function password($data)
    {
        $validator = Validator::make($data->all(), [
            'password' => 'confirmed|min:5|required',
        ], [
            'password.confirmed' => 'Password tidak sama.',
            'password.min' => 'Password kurang dari 5 karakter.',
            'password.required' => 'Password harus diisi.',
        ]);

        return $validator;
    }

    public static function email($data)
    {
        $validator = Validator::make($data->all(), [
            'email' => 'unique:users|required',
        ], [
            'email.unique' => 'Email sudah ada yang menggunakan.',
            'email.required' => 'Email harus diisi.',
        ]);

        return $validator;
    }

    public static function nik($data)
    {
        $validator = Validator::make($data->all(), [
            'nik' => 'unique:pengajars|required|min:16|max:16',
        ], [
            'nik.unique' => 'NIK sudah ada yang menggunakan.',
            'nik.required' => 'NIK harus diisi.',
            'nik.min' => 'NIK kurang dari 16 digit.',
            'nik.max' => 'NIK lebih dari 16 digit.',
        ]);

        return $validator;
    }
}
