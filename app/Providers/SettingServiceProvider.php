<?php

namespace App\Providers;

use Exception;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Service update semua data setting madin
     */
    public static function updateSetting($request)
    {
        try {
            $nama = Setting::setSettingMadin('nama_madin', $request->nama_madin);
            $alamat = Setting::setSettingMadin('alamat_madin', $request->alamat_madin);
            $kota =  Setting::setSettingMadin('kota_madin', $request->kota_madin);
            $kode_pos = Setting::setSettingMadin('kode_pos_madin', $request->kode_pos_madin);
            $telp = Setting::setSettingMadin('telp_madin', $request->telp_madin);
            $email =  Setting::setSettingMadin('email_madin', $request->email_madin);
            $statistik =  Setting::setSettingMadin('nomor_statistik_madin', $request->nomor_statistik_madin);
            $notaris =  Setting::setSettingMadin('nomor_notaris_madin', $request->nomor_notaris_madin);
            $kepala =  Setting::setSettingMadin('nama_kepala_madin', $request->nama_kepala_madin);
            $bendahara =  Setting::setSettingMadin('nama_bendahara_madin', $request->nama_bendahara_madin);
            $sekretaris =  Setting::setSettingMadin('nama_sekretaris_madin', $request->nama_sekretaris_madin);

            if (
                $nama &&
                $alamat &&
                $kota &&
                $kode_pos &&
                $telp &&
                $email &&
                $statistik &&
                $notaris &&
                $kepala &&
                $bendahara &&
                $sekretaris
            ) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
