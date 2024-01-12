<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSantri extends Model
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
        'pelajaran_id',
        'santri_id',
        'musyafahat',
        'kitabah',
    ];

    /**
     * method model untuk ambil nilai santri by periode_id, kelas_id, pelajaran_id, santri_id
     */
    public static function getNilaiSantri($periode_id, $kelas_id, $pelajaran_id, $santri_id)
    {
        return NilaiSantri::where([
            ['periode_id', '=', $periode_id],
            ['kelas_id', '=', $kelas_id],
            ['pelajaran_id', '=', $pelajaran_id],
            ['santri_id', '=', $santri_id]
        ])->first();
    }
}
