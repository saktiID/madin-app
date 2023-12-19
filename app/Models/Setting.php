<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
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
        'nilai_setting',
    ];

    /**
     * method model get data setting madin
     * 
     * @var string
     */
    public static function getSettingMadin($nama_setting): string
    {
        $data = DB::table('settings')
            ->select('nilai_setting')
            ->where('nama_setting', $nama_setting)->first();

        return $data->nilai_setting;
    }

    /**
     * method model get seluruh data setting maidn
     * 
     * @var array<int, string>
     */
    public static function getAllSettingMadin(): array
    {
        $data = [
            'logo_madin' => Setting::getSettingMadin('logo_madin'),
            'nama_madin' => Setting::getSettingMadin('nama_madin'),
            'alamat_madin' => Setting::getSettingMadin('alamat_madin'),
            'kota_madin' => Setting::getSettingMadin('kota_madin'),
            'kode_pos_madin' => Setting::getSettingMadin('kode_pos_madin'),
            'telp_madin' => Setting::getSettingMadin('telp_madin'),
            'email_madin' => Setting::getSettingMadin('email_madin'),
            'nomor_statistik_madin' => Setting::getSettingMadin('nomor_statistik_madin'),
            'nomor_notaris_madin' => Setting::getSettingMadin('nomor_notaris_madin'),
            'nama_kepala_madin' => Setting::getSettingMadin('nama_kepala_madin'),
            'nama_bendahara_madin' => Setting::getSettingMadin('nama_bendahara_madin'),
            'nama_sekretaris_madin' => Setting::getSettingMadin('nama_sekretaris_madin'),
        ];

        return $data;
    }

    /**
     * method model set data setting madin
     * 
     * @bool true|false
     */
    public static function setSettingMadin($nama_setting, $nilai_setting_baru)
    {
        $update = DB::table('settings')
            ->where('nama_setting', $nama_setting)
            ->update(['nilai_setting' => $nilai_setting_baru]);

        if ($update) {
            return true;
        } else {
            return false;
        }
    }
}
