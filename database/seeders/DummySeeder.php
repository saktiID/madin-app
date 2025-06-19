<?php

namespace Database\Seeders;

use App\Models\Santri;
use App\Models\User;
use App\Models\Ustadz;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat akun random ustadz
        for ($i = 1; $i <= 50; $i++) {
            DB::transaction(function () use ($i) {
                $ustadz = User::create([
                    "name" => fake()->name(),
                    "email" => fake()->unique()->safeEmail(),
                    'password' => Hash::make("ustadz5758"),
                    'role' => 'ustadz',
                    'avatar' => null,
                    'email_verified_at' => now(),
                ]);

                Ustadz::create([
                    'user_id' => $ustadz->id,
                    'no_telepon' => '08' . fake()->unique()->numerify('#########'),
                    'nik' => fake()->unique()->numerify('################'),
                    'gender' => 'L',
                    'alamat' => fake()->address(),
                ]);
            });
        }

        for ($x = 1; $x <= 50; $x++) {
            Santri::create([
                "avatar" => null,
                "nama" => fake()->name(),
                "nis" => fake()->unique()->numerify('#########'),
                'nik' => fake()->unique()->numerify('################'),
                "gender" => rand(0, 1) ? "P" : "L",
                "tempat_lahir" => fake()->city(),
                "tanggal_lahir" => fake()->date(),
                "alamat" => fake()->address(),
                "tahun_masuk" => '2025',
            ]);
        }
    }
}
