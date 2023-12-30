<?php

namespace App\Providers\santri;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class SantriValidatorServiceProvider extends ServiceProvider
{
    public static function validate($data)
    {
        $validator = Validator::make($data->all(), [
            'nik' => 'min:16|max:16|unique:santris',
            'nis' => 'unique:santris',
        ], [
            'nik.max' => 'NIK lebih dari 16 digit.',
            'nik.min' => 'NIK kurang dari 16 digit.',
            'nik.unique' => 'NIK sudah ada yang menggunakan.',
            'nis.unique' => 'NIS sudah ada yang menggunakan.'
        ]);

        return $validator;
    }

    public static function nik($data)
    {
        $validator = Validator::make($data->all(), [
            'nik' => 'min:16|max:16|unique:santris',
        ], [
            'nik.max' => 'NIK lebih dari 16 digit.',
            'nik.min' => 'NIK kurang dari 16 digit.',
            'nik.unique' => 'NIK sudah ada yang menggunakan.',
        ]);

        return $validator;
    }

    public static function nis($data)
    {
        $validator = Validator::make($data->all(), [
            'nis' => 'unique:santris',
        ], [
            'nis.unique' => 'NIS sudah ada yang menggunakan.'
        ]);

        return $validator;
    }
}
