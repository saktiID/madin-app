<?php

namespace App\Providers;

use App\Models\Periode;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class GlobalDataServiceProvider extends ServiceProvider
{
    public static function get()
    {
        $binding = Setting::select(['nama_setting', 'nilai_setting'])
            ->where('nama_setting', 'logo_madin')
            ->orWhere('nama_setting', 'nama_madin')
            ->orWhere('nama_setting', 'alamat_madin')
            ->pluck('nilai_setting', 'nama_setting');

        // $data['logo_madin'] = Setting::getSettingMadin('logo_madin');
        // $data['nama_madin'] = Setting::getSettingMadin('nama_madin');
        // $data['alamat_madin'] = Setting::getSettingMadin('alamat_madin');
        $data['logo_madin'] = $binding['logo_madin'];
        $data['nama_madin'] = $binding['nama_madin'];
        $data['alamat_madin'] = $binding['alamat_madin'];

        if (!request()->is('/')) {
            $data['periode'] = Periode::getAllPeriode();
        }

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
