<?php

namespace App\Providers;

use App\Models\Periode;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class GlobalDataServiceProvider extends ServiceProvider
{
    public static function get()
    {
        $data['logo_madin'] = Setting::getSettingMadin('logo_madin');
        $data['nama_madin'] = Setting::getSettingMadin('nama_madin');
        $data['alamat_madin'] = Setting::getSettingMadin('alamat_madin');
        $data['periode'] = Periode::getAllPeriode();

        if (session()->has('periode')) {
            $data['currentPeriode'] = [
                'tahun_ajaran' => session()->get('periode')['tahun_ajaran'],
                'semester' => session()->get('periode')['semester']
            ];
        } else {
            $data['currentPeriode'] = [
                'tahun_ajaran' => '-',
                'semester' => '-'
            ];
        }

        return $data;
    }
}
