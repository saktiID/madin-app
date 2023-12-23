<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'nama_madin',
            'nilai_setting' => 'Nurul Ulum Al Fath',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'logo_madin',
            'nilai_setting' => 'logo-6581d7b38f324.png',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'alamat_madin',
            'nilai_setting' => 'Jl. Kedung Kendo No. 313 Candi 61271, Sidoarjo',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'kota_madin',
            'nilai_setting' => 'Sidoarjo',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'kode_pos_madin',
            'nilai_setting' => '61271',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'telp_madin',
            'nilai_setting' => '08123456789',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'email_madin',
            'nilai_setting' => 'madinapp@madin.app',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'nomor_statistik_madin',
            'nilai_setting' => '311233120001',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'nomor_notaris_madin',
            'nilai_setting' => 'AHU-2269.A.H.02.01.Tahun.2023',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'nama_kepala_madin',
            'nilai_setting' => 'Sipaling Ustadz, S. Pd.I',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'nama_bendahara_madin',
            'nilai_setting' => 'Pak Ustadz, SE',
        ]);

        Setting::create([
            'id' => Str::uuid(),
            'nama_setting' => 'nama_sekretaris_madin',
            'nilai_setting' => 'Mas Sekretaris, S. Kom',
        ]);
    }
}
