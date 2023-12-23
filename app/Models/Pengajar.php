<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengajar extends Model
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
        'user_id',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'pendidikan_islam',
        'telp',
        'alamat',
        'kabupaten',
        'provinsi',
    ];

    /**
     * method model ambil daftar data asatidz
     * 
     * @var Collection
     */
    public static function getListDataAsatidz()
    {
        $asatidz = DB::table('users')
            ->join('pengajars', 'users.id', '=', 'pengajars.user_id')
            ->select(
                'pengajars.id as pengajar_id',
                'users.id as user_id',
                'users.nama',
                'users.email',
                'pengajars.telp',
                'users.avatar',
                'users.gender'
            )
            ->latest('pengajars.created_at')->get();

        return $asatidz;
    }

    /**
     * method model ambil profile asatidz by id pengajar
     */
    public static function getProfileAsatidz($id_asatidz)
    {
        $profile_asatidz = DB::table('users')
            ->join('pengajars', 'users.id', '=', 'pengajars.user_id')
            ->where('users.id', '=', $id_asatidz)
            ->select(
                'pengajars.id as pengajar_id',
                'users.nama',
                'users.email',
                'users.role',
                'users.gender',
                'users.avatar',
                'users.id as user_id',
                'pengajars.nik',
                'pengajars.tempat_lahir',
                'pengajars.tanggal_lahir',
                'pengajars.pendidikan_terakhir',
                'pengajars.pendidikan_islam',
                'pengajars.telp',
                'pengajars.alamat',
                'pengajars.kabupaten',
                'pengajars.provinsi',
            )
            ->first();

        return $profile_asatidz;
    }
}
