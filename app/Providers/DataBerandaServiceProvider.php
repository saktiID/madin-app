<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class DataBerandaServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Menggunakan view composer untuk membagikan data ke setiap view
        View::composer('*', function ($view) {
            // Gantilah bagian ini dengan data yang ingin Anda kirim ke setiap view
            $data = [];
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

            $view->with($data);
        });
    }
}
