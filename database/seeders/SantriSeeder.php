<?php

namespace Database\Seeders;

use App\Models\Santri;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SantriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Santri::create([
            'id' => Str::uuid(),
            'nama_santri' => 'Muhammad Syakur',
            'avatar' => '90x90.jpg',
            'nis' => '202312780001',
            'nik' => '3515052506050001',
            'gender' => 'male',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '12/02/2008',
            'alamat' => 'Ds. Wonosae No. 22, Krian Sidoarjo',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
        ]);

        Santri::create([
            'id' => Str::uuid(),
            'nama_santri' => 'Karim Junaidi',
            'avatar' => '90x90.jpg',
            'nis' => '202312780002',
            'nik' => '3515052506050002',
            'gender' => 'male',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '12/02/2008',
            'alamat' => 'Ds. Semawur No. 32, Gedangan Sidoarjo',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
        ]);

        Santri::create([
            'id' => Str::uuid(),
            'nama_santri' => 'Sinthia Lubis',
            'avatar' => '90x90.jpg',
            'nis' => '202312780003',
            'nik' => '3515052506060003',
            'gender' => 'female',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '12/02/2008',
            'alamat' => 'Ds. Kolosebo No. 15, Wonoayu Sidoarjo',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
        ]);
    }
}
