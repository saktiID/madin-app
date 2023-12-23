<?php

namespace Database\Seeders;

use App\Models\Pengajar;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengajar::create([
            'id' => Str::uuid(),
            'user_id' => '74a60478-d675-44c8-b196-7a0203b2b441',
            'nik' => '3515082508880001',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '25/08/1988',
            'pendidikan_terakhir' => 'Sarjana Akhirat',
            'pendidikan_islam' => 'Pondok Salaf',
            'telp' => '081234567890',
            'alamat' => 'Ds. Kedung Kendo No 313, Candi Sidoarjo',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
        ]);

        Pengajar::create([
            'id' => Str::uuid(),
            'user_id' => 'de6c287f-e126-4eb4-b5a8-aeef4c652d2e',
            'nik' => '3515122508880004',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '25/08/1988',
            'pendidikan_terakhir' => 'Sarjana Akhirat',
            'pendidikan_islam' => 'Pondok Salaf',
            'telp' => '081234567890',
            'alamat' => 'Ds. Kedung Kendo No 313, Candi Sidoarjo',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
        ]);

        Pengajar::create([
            'id' => Str::uuid(),
            'user_id' => 'de6c287f-e126-4eb4-b5a8-aeef4c652bc4',
            'nik' => '3515122508880005',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '25/08/1988',
            'pendidikan_terakhir' => 'Sarjana Akhirat',
            'pendidikan_islam' => 'Pondok Salaf',
            'telp' => '081234567890',
            'alamat' => 'Ds. Kedung Kendo No 313, Candi Sidoarjo',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
        ]);
    }
}
