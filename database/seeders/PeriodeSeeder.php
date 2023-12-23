<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Periode::create([
            'id' => Str::uuid(),
            'tahun_ajaran' => '2023-2024',
            'semester' => 'Ganjil',
        ]);

        Periode::create([
            'id' => Str::uuid(),
            'tahun_ajaran' => '2023-2024',
            'semester' => 'Genap',
        ]);

        Periode::create([
            'id' => Str::uuid(),
            'tahun_ajaran' => '2024-2025',
            'semester' => 'Ganjil',
        ]);

        Periode::create([
            'id' => Str::uuid(),
            'tahun_ajaran' => '2024-2025',
            'semester' => 'Genap',
        ]);
    }
}
