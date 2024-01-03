<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Periode extends Model
{
    use HasFactory, HasUuids;

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
        'tahun_ajaran',
        'semester',
    ];

    /**
     * method model get data periode
     * 
     * @var string
     */
    public static function getAllPeriode()
    {
        $periode = DB::table('periodes')
            ->orderBy('tahun_ajaran', 'ASC')
            ->orderBy('semester', 'ASC')
            ->get();
        return $periode;
    }
}
