<?php

namespace App\Providers;

use App\Models\Periode;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Menggunakan view composer untuk membagikan data ke setiap view
        View::composer('*', function ($view) {
            // Gantilah bagian ini dengan data yang ingin Anda kirim ke setiap view
            $data = [
                'logo_madin' => Setting::getSettingMadin('logo_madin'),
                'nama_madin' => Setting::getSettingMadin('nama_madin'),
                'alamat_madin' => Setting::getSettingMadin('alamat_madin'),
                'periode' => Periode::getAllPeriode(),
            ];

            $view->with($data);
        });
    }
}
