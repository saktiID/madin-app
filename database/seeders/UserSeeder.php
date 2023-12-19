<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => Str::uuid(),
            'nama' => 'Sipaling Ustadz',
            'email' => 'admin@madin.app',
            'role' => 'Administrator',
            'gender' => 'male',
            'avatar' => '/img/user-male-90x90.png',
            'password' => Hash::make('admin')
        ]);

        User::create([
            'id' => Str::uuid(),
            'nama' => 'Pak Ustadz',
            'email' => 'ustadz@madin.app',
            'role' => 'Ustadz',
            'gender' => 'male',
            'avatar' => '/img/user-male-90x90.png',
            'password' => Hash::make('ustadz')
        ]);
    }
}
