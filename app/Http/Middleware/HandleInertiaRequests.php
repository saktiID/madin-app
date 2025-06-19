<?php

namespace App\Http\Middleware;

use Closure;
use Inertia\Middleware;
use App\Models\Identitas;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek jika URI saat ini adalah /install atau /install/*
        if ($request->is('install') || $request->is('install/*')) {
            return $next($request); // Lewati proses Inertia
        }

        // Jika bukan, lanjutkan seperti biasa
        return parent::handle($request, $next);
    }

    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
                'info' => fn() => $request->session()->get('info'),
            ],
            'madin' => [
                'logo_madin' => Identitas::where('slug', 'logo_madin')->select('deskripsi_identitas')->first()->deskripsi_identitas,
                'nama_madin' => Identitas::where('slug', 'nama_madin')->select('deskripsi_identitas')->first()->deskripsi_identitas,
                'alamat_madin' => Identitas::where('slug', 'alamat_madin')->select('deskripsi_identitas')->first()->deskripsi_identitas,
            ],
        ];
    }
}
