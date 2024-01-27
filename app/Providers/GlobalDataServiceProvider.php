<?php

namespace App\Providers;

use App\Models\Periode;
use App\Models\Setting;
use App\Models\Pelajaran;
use Illuminate\Support\ServiceProvider;

class GlobalDataServiceProvider extends ServiceProvider
{
    public static function get()
    {
        $binding = Setting::select(['nama_setting', 'nilai_setting'])
            ->where('nama_setting', 'logo_madin')
            ->orWhere('nama_setting', 'nama_madin')
            ->orWhere('nama_setting', 'alamat_madin')
            ->orWhere('nama_setting', 'kota_madin')
            ->pluck('nilai_setting', 'nama_setting');

        // $data['logo_madin'] = Setting::getSettingMadin('logo_madin');
        // $data['nama_madin'] = Setting::getSettingMadin('nama_madin');
        // $data['alamat_madin'] = Setting::getSettingMadin('alamat_madin');
        $data['logo_madin'] = $binding['logo_madin'];
        $data['nama_madin'] = $binding['nama_madin'];
        $data['alamat_madin'] = $binding['alamat_madin'];
        $data['kota_madin'] = $binding['kota_madin'];
        $data['pelajaran'] = Pelajaran::getListPelajaranActive();
        $data['version'] = "1.1.3.2024";

        if (!request()->is('/')) {
            $data['periode'] = Periode::getAllPeriode();
        }

        if (session()->has('periode')) {
            $data['currentPeriode'] = [
                'tahun_ajaran' => session()->get('periode')['tahun_ajaran'],
                'semester' => session()->get('periode')['semester'],
                'id' => session()->get('periode')['id']
            ];
        } else {
            $data['currentPeriode'] = [
                'tahun_ajaran' => '-',
                'semester' => '-',
                'id' => '-'
            ];
        }

        return $data;
    }
}
