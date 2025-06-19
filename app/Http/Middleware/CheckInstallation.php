<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!env('APP_INSTALLED')) {
            // Hindari loop: pastikan hanya route root yang dialihkan
            if (!str_starts_with($_SERVER['REQUEST_URI'], '/install')) {
                return redirect('/install');
            }
        } else {
            // Jika sudah terinstal, pastikan tidak mengakses halaman instalasi
            $path = str_starts_with($_SERVER['REQUEST_URI'], '/install');
            $is_installed = env('APP_INSTALLED');
            $is_migrated = env('DB_MIGRATED');

            if ($is_installed && $is_migrated && $path) {
                return redirect('/login');
            }
        }

        return $next($request);
    }
}
