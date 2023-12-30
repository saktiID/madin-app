<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
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
        'nama_kelas',
        'bagian_kelas',
        'jenjang_kelas',
        'mustahiq_id',
    ];

    /**
     * method model get list kelas by periode id
     */
    public static function getListKelas($periode_id)
    {
        $kelas = DB::table('kelas')
            ->where('periode_id', $periode_id)
            ->orderBy('jenjang_kelas', 'asc')
            ->orderBy('nama_kelas', 'asc')
            ->orderBy('bagian_kelas', 'asc')
            ->get();

        return $kelas;
    }
}
