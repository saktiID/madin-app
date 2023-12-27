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
            )->latest('santris.created_at')->get();

        return $santri;
    }

    public static function getProfileSantri($id)
    {
        $santri = DB::table('santris')->where('id', '=', $id)->select(
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
        )->first();

        return $santri;
    }
}
