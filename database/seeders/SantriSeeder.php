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

            // data akun
            'id' => Str::uuid(),
            'avatar' => 'user-male-90x90.png',

            // data santri
            'nama_santri' => 'Muhammad Syakur',
            'nis' => '202312780001',
            'no_kk' => '3515052506255351',
            'nik' => '3515052506050001',
            'nama_kepala_keluarga' => 'Pak Mudzakkir',
            'gender' => 'male',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '12/02/2008',
            'jumlah_saudara' => '5',
            'anak_ke' => '2',
            'cita_cita' => 'Guru',
            'hobi' => 'Membaca',
            'telp' => '',
            'email' => '',
            'pembiaya' => 'Orang tua',
            'kebutuhan_khusus' => 'Tidak ada',
            'kebutuhan_disabilitas' => 'Tidak ada',

            // data orang tua
            'nama_ayah' => 'Mudzakkir',
            'status_ayah' => 'Masih hidup',
            'kewaraganegaraan_ayah' => 'WNI',
            'nik_ayah' => '3515052506050001',
            'tempat_lahir_ayah' => 'Sidoarjo',
            'tanggal_lahir_ayah' => '12/02/2008',
            'pendidikan_terakhir_ayah' => 'S1',
            'pekerjaan_ayah' => 'Guru',
            'penghasilan_ayah' => '3.000.000 - 5.000.000',
            'telp_ayah' => '08123456789',

            'nama_ibu' => 'Muslihah',
            'status_ibu' => 'Masih hidup',
            'kewaraganegaraan_ibu' => 'WNI',
            'nik_ibu' => '3515052506050001',
            'tempat_lahir_ibu' => 'Sidoarjo',
            'tanggal_lahir_ibu' => '12/02/2008',
            'pendidikan_terakhir_ibu' => 'S1',
            'pekerjaan_ibu' => 'Guru',
            'penghasilan_ibu' => '2.000.000 - 3.000.000',
            'telp_ibu' => '08123456789',

            // data alamat
            'alamat' => 'Ds. Wonosae No. 22, Krian Sidoarjo',
            'kelurahan' => 'Wonosae',
            'rt' => '001',
            'rw' => '001',
            'kode_pos' => '61251',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',

            'tahun_masuk' => '2023',
            'is_active' => true,
        ]);

        Santri::create([

            // data akun
            'id' => Str::uuid(),
            'avatar' => 'user-male-90x90.png',

            // data santri
            'nama_santri' => 'Karim Junaidi',
            'nis' => '202312780002',
            'no_kk' => '3515052506255351',
            'nik' => '3515052506050002',
            'nama_kepala_keluarga' => 'Pak Mudzakkir',
            'gender' => 'male',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '12/02/2008',
            'jumlah_saudara' => '5',
            'anak_ke' => '2',
            'cita_cita' => 'Guru',
            'hobi' => 'Membaca',
            'telp' => '',
            'email' => '',
            'pembiaya' => 'Orang tua',
            'kebutuhan_khusus' => 'Tidak ada',
            'kebutuhan_disabilitas' => 'Tidak ada',

            // data orang tua
            'nama_ayah' => 'Mudzakkir',
            'status_ayah' => 'Masih hidup',
            'kewaraganegaraan_ayah' => 'WNI',
            'nik_ayah' => '3515052506050001',
            'tempat_lahir_ayah' => 'Sidoarjo',
            'tanggal_lahir_ayah' => '12/02/2008',
            'pendidikan_terakhir_ayah' => 'S1',
            'pekerjaan_ayah' => 'Guru',
            'penghasilan_ayah' => '2.000.000 - 3.000.000',
            'telp_ayah' => '08123456789',

            'nama_ibu' => 'Muslihah',
            'status_ibu' => 'Masih hidup',
            'kewaraganegaraan_ibu' => 'WNI',
            'nik_ibu' => '3515052506050001',
            'tempat_lahir_ibu' => 'Sidoarjo',
            'tanggal_lahir_ibu' => '12/02/2008',
            'pendidikan_terakhir_ibu' => 'S1',
            'pekerjaan_ibu' => 'Guru',
            'penghasilan_ibu' => '2.000.000 - 3.000.000',
            'telp_ibu' => '08123456789',

            // data alamat
            'alamat' => 'Ds. Semawur No. 32, Gedangan Sidoarjo',
            'kelurahan' => 'Wonosae',
            'rt' => '001',
            'rw' => '001',
            'kode_pos' => '61251',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',

            'tahun_masuk' => '2023',
            'is_active' => true,

        ]);

        Santri::create([

            // data akun
            'id' => Str::uuid(),
            'avatar' => 'user-female-90x90.png',

            // data santri
            'nama_santri' => 'Sinthia Lubis',
            'nis' => '202312780003',
            'no_kk' => '3515052506255352',
            'nik' => '3515052506050005',
            'nama_kepala_keluarga' => 'Pak Mudzakkir',
            'gender' => 'female',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '12/02/2008',
            'jumlah_saudara' => '5',
            'anak_ke' => '2',
            'cita_cita' => 'Guru',
            'hobi' => 'Membaca',
            'telp' => '',
            'email' => '',
            'pembiaya' => 'Orang tua',
            'kebutuhan_khusus' => 'Tidak ada',
            'kebutuhan_disabilitas' => 'Tidak ada',

            // data orang tua
            'nama_ayah' => 'Mudzakkir',
            'status_ayah' => 'Masih hidup',
            'kewaraganegaraan_ayah' => 'WNI',
            'nik_ayah' => '3515052506050001',
            'tempat_lahir_ayah' => 'Sidoarjo',
            'tanggal_lahir_ayah' => '12/02/2008',
            'pendidikan_terakhir_ayah' => 'S1',
            'pekerjaan_ayah' => 'Guru',
            'penghasilan_ayah' => '2.000.000 - 3.000.000',
            'telp_ayah' => '08123456789',

            'nama_ibu' => 'Muslihah',
            'status_ibu' => 'Masih hidup',
            'kewaraganegaraan_ibu' => 'WNI',
            'nik_ibu' => '3515052506050001',
            'tempat_lahir_ibu' => 'Sidoarjo',
            'tanggal_lahir_ibu' => '12/02/2008',
            'pendidikan_terakhir_ibu' => 'S1',
            'pekerjaan_ibu' => 'Guru',
            'penghasilan_ibu' => '2.000.000 - 3.000.000',
            'telp_ibu' => '08123456789',

            // data alamat
            'alamat' => 'Ds. Kolosebo No. 15, Wonoayu Sidoarjo',
            'kelurahan' => 'Wonosae',
            'rt' => '001',
            'rw' => '001',
            'kode_pos' => '61251',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',

            'tahun_masuk' => '2023',
            'is_active' => true,
        ]);
    }
}
