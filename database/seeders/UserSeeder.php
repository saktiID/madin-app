<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ustadz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat akun admin
        User::create([
            "name" => "Admin Madin App",
            "email" => "admin@madin.app",
            'password' => Hash::make('admin5758'),
            'role' => 'admin',
            'avatar' => null,
            'email_verified_at' => now(),
        ]);

        // membuat akun ustadz
        DB::transaction(function () {
            $ustadz =  User::create([
                "name" => "Ustadz Madin App",
                "email" => "ustadz@madin.app",
                'password' => Hash::make('ustadz5758'),
                'role' => 'ustadz',
                'avatar' => null,
                'email_verified_at' => now(),
            ]);

            Ustadz::create([
                'user_id' => $ustadz->id,
                'no_telepon' => '081234567890',
                'nik' => '1234567890123456',
                'gender' => 'L',
                'alamat' => 'Jl. Raya No. 1',
            ]);
        });
    }
}
