<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id' => '74a60478-d675-44c8-b196-7a0203b2b441',
            'nama' => 'Sipaling Ustadz',
            'email' => 'admin@madin.app',
            'role' => 'Administrator',
            'gender' => 'male',
            'avatar' => 'profile-65871c430292b.png',
            'password' => Hash::make('admin')
        ]);

        User::create([
            'id' => 'de6c287f-e126-4eb4-b5a8-aeef4c652d2e',
            'nama' => 'Pak Ustadz',
            'email' => 'ustadz@madin.app',
            'role' => 'Asatidz',
            'gender' => 'male',
            'avatar' => 'profile-65871b7ae538f.png',
            'password' => Hash::make('ustadz')
        ]);

        User::create([
            'id' => 'de6c287f-e126-4eb4-b5a8-aeef4c652bc4',
            'nama' => 'Bu Ustadzah',
            'email' => 'ustadzah@madin.app',
            'role' => 'Asatidz',
            'gender' => 'female',
            'avatar' => 'profile-65871bf4e9701.png',
            'password' => Hash::make('ustadzah')
        ]);
    }
}
