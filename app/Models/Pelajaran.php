<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pelajaran extends Model
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
        'nama_pelajaran',
        'deskripsi',
        'is_active',
    ];

    /**
     * method model get list pelajaran
     */
    public static function getListPelajaran()
    {
        $pelajaran = DB::table('pelajarans')
            ->select(['*'])
            ->latest()->get();

        return $pelajaran;
    }

    /**
     * method model get list pelajaran active
     */
    public static function getListPelajaranActive()
    {
        $pelajaran = DB::table('pelajarans')
            ->where('is_active', 1)
            ->select(['*'])
            ->latest()->get();

        return $pelajaran;
    }
}
