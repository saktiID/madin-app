<?php

namespace App\Providers;

use App\Models\Setting;
use Exception;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Service update semua data setting madin
     */
    public static function updateSetting($request)
    {
        try {
            Setting::setSettingMadin('nama_madin', $request->nama_madin);
            Setting::setSettingMadin('alamat_madin', $request->alamat_madin);
            Setting::setSettingMadin('kota_madin', $request->kota_madin);
            Setting::setSettingMadin('kode_pos_madin', $request->kode_pos_madin);
            Setting::setSettingMadin('telp_madin', $request->telp_madin);
            Setting::setSettingMadin('email_madin', $request->email_madin);
            Setting::setSettingMadin('nomor_statistik_madin', $request->nomor_statistik_madin);
            Setting::setSettingMadin('nomor_notaris_madin', $request->nomor_notaris_madin);
            Setting::setSettingMadin('nama_kepala_madin', $request->nama_kepala_madin);
            Setting::setSettingMadin('nama_bendahara_madin', $request->nama_bendahara_madin);
            Setting::setSettingMadin('nama_sekretaris_madin', $request->nama_sekretaris_madin);

            return true;
        } catch (Exception $e) {
            return $e;
        }
    }
}
