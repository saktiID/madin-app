<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory;

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nama_santri',
        'avatar',
        'nis',
        'nik',
        'gender',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'kabupaten',
        'provinsi',
        'tahun_masuk',
        'tahun_keluar',
        'tahun_lulus',
        'is_active',

        'no_kk',
        'nama_kepala_keluarga',
        'jumlah_saudara',
        'anak_ke',
        'cita_cita',
        'hobi',
        'telp',
        'email',
        'pembiaya',
        'kebutuhan_khusus',
        'kebutuhan_disabilitas',

        'nama_ayah',
        'status_ayah',
        'kewaraganegaraan_ayah',
        'nik_ayah',
        'tempat_lahir_ayah',
        'tanggal_lahir_ayah',
        'pendidikan_terakhir_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'telp_ayah',

        'nama_ibu',
        'status_ibu',
        'kewaraganegaraan_ibu',
        'nik_ibu',
        'tempat_lahir_ibu',
        'tanggal_lahir_ibu',
        'pendidikan_terakhir_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'telp_ibu',

        'kelurahan',
        'rt',
        'rw',
        'kode_pos',

    ];

    /**
     * method model ambil daftar data santri
     */
    public static function getListDataSantri()
    {
        $santri = DB::table('santris')
            ->select(
                'id',
                'nama_santri as nama',
                'avatar',
                'nis',
                'tahun_masuk',
                'is_active',
            )->latest('santris.created_at')->get();

        return $santri;
    }

    /**
     * method model ambil daftar data santri active
     */
    public static function getListDataSantriActive()
    {
        $santri = DB::table('santris')
            ->where('is_active', '=', 1)
            ->select(
                'id',
                'nama_santri as nama',
                'avatar',
                'nis',
                'tahun_masuk',
                'is_active',
            )->latest('santris.created_at')->get();

        return $santri;
    }

    /**
     * method model ambil detail santri
     */
    public static function getProfileSantri($id)
    {
        $santri = DB::table('santris')->where('id', '=', $id)
            ->select(
                'id',
                'nama_santri as nama',
                'avatar',
                'nis',
                'nik',
                'gender',
                'tempat_lahir',
                'tanggal_lahir',
                'alamat',
                'kabupaten',
                'provinsi',
                'tahun_masuk',
                'tahun_keluar',
                'tahun_lulus',
                'is_active',
            )->first();

        return $santri;
    }

    /**
     * method model ambil detail emis santri
     */
    public static function getProfileEmisSantri($id)
    {
        $santri = DB::table('santris')->where('id', '=', $id)
            ->select('*', 'nama_santri as nama')->first();

        return $santri;
    }
}
