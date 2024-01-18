<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelasSantri extends Model
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
        'periode_id',
        'kelas_id',
        'santri_id',
    ];

    /**
     * method model cek santri dalam kelas
     */
    public static function cekSantriKelas($santri_id, $periode_id)
    {
        return KelasSantri::where('santri_id', $santri_id)
            ->where('periode_id', $periode_id)
            ->exists();
    }

    /**
     * method mode cek santri dalam kelas by kelas_santris id
     */
    public static function cekSantriKelasById($id)
    {
        return KelasSantri::where('id', $id)->exists();
    }

    /**
     * method model untuk ambil data santri ada di kelas mana by id
     */
    public static function getSantriDiKelasManaById($periode_id, $santri_id)
    {
        return DB::table('kelas_santris')
            ->where('kelas_santris.santri_id', '=', $santri_id)
            ->where('kelas_santris.periode_id', '=', $periode_id)
            ->join('santris', 'kelas_santris.santri_id', '=', 'santris.id')
            ->join('kelas', 'kelas_santris.kelas_id', '=', 'kelas.id')
            ->join('periodes', 'kelas_santris.periode_id', '=', 'periodes.id')
            ->join('users', 'kelas.mustahiq_id', '=', 'users.id')
            ->select('*')
            ->select([
                'users.nama as nama_mustahiq',
                'santris.nama_santri as nama_santri',
                'santris.id as santri_id',
                'santris.nis',
                'kelas.nama_kelas',
                'kelas.bagian_kelas',
                'kelas.jenjang_kelas',
                'kelas_santris.kelas_id',
                'periodes.semester',
                'periodes.tahun_ajaran',
            ])
            ->first();
    }

    /**
     * method model ambil data santri dalam kelas
     */
    public static function getListSantriKelas($periode_id, $kelas_id)
    {
        $list_santri_kelas = DB::table('kelas_santris')
            ->join('santris', 'kelas_santris.santri_id', '=', 'santris.id')
            ->where([
                ['kelas_santris.periode_id', '=', $periode_id],
                ['kelas_santris.kelas_id', '=', $kelas_id]
            ])
            ->select([
                'kelas_santris.id as id',
                'kelas_santris.periode_id',
                'kelas_santris.kelas_id',
                'santris.id as santri_id',
                'santris.nama_santri',
                'santris.avatar',
                'santris.nis',
            ])
            ->orderBy('santris.nama_santri', 'ASC')
            ->get();

        return $list_santri_kelas;
    }
}
