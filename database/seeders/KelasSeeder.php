<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'id' => Str::uuid(),
            'periode_id' => 'f27a80e2-9e52-453e-a1e1-f2deebbcf738',
            'nama_kelas' => "1 Ibtida'iyyah",
            'bagian_kelas' => 'A',
            'jenjang_kelas' => '1',
            'mustahiq_id' => null,
        ]);
    }
}
