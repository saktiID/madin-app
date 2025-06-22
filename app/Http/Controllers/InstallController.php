<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InstallerService;
use Illuminate\Support\Facades\Artisan;

class InstallController extends Controller
{
    public function show()
    {
        $requiredExtensions = [
            'bcmath',
            'ctype',
            'curl',
            'dom',
            'fileinfo',
            'intl',
            'json',
            'libxml',
            'mbstring',
            'openssl',
            'pdo',
            'pdo_mysql',
            'tokenizer',
            'xml',
            'zip',
            'exif',
            'iconv'
        ];

        $extensionsStatus = collect($requiredExtensions)->map(function ($ext) {
            return [
                'name' => $ext,
                'loaded' => extension_loaded($ext),
                'note' => null
            ];
        });

        // Khusus gd / imagick
        $gdLoaded = extension_loaded('gd');
        $imagickLoaded = extension_loaded('imagick');
        $imageSupport = [
            'name' => 'gd / imagick',
            'loaded' => $gdLoaded || $imagickLoaded,
            'note' => $gdLoaded && $imagickLoaded
                ? 'Keduanya aktif, bisa pilih salah satu'
                : ($gdLoaded ? 'gd aktif' : ($imagickLoaded ? 'imagick aktif' : 'Keduanya tidak aktif'))
        ];

        // Gabungkan semua
        $extensionsStatus->push($imageSupport);

        return view('installer.index', compact('extensionsStatus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'db_host' => 'required',
            'db_port' => 'required|numeric',
            'db_name' => 'required',
            'db_user' => 'required',
        ]);

        $connectionTest = InstallerService::testDatabaseConnection(
            $request->db_host,
            $request->db_port,
            $request->db_name,
            $request->db_user,
            $request->db_pass
        );
        if (!$connectionTest['success']) {
            return redirect()->back()->withErrors(['db' => $connectionTest['message']]);
        }

        $changeEnv = InstallerService::updateEnv([
            'DB_HOST'     => $request->db_host,
            'DB_PORT'     => $request->db_port,
            'DB_DATABASE' => $request->db_name,
            'DB_USERNAME' => $request->db_user,
            'DB_PASSWORD' => $request->db_pass,
            'APP_INSTALLED' => 'true',
        ]);
        if (!$changeEnv['success']) {
            return redirect()->back()->withErrors(['db' => $changeEnv['message']]);
        }

        return redirect()->back()->withInput()->with('success', 'Berhasil test koneksi database.');
    }

    public function migrate()
    {
        $runArtisan = InstallerService::setupArtisanCommands();
        if (!$runArtisan['success']) {
            return redirect()->back()->withErrors(['db' => $runArtisan['message']]);
        }

        $changeEnv = InstallerService::updateEnv([
            'SESSION_DRIVER' => 'database',
            'CACHE_STORE' => 'database',
            'DB_MIGRATED' => 'true',
        ]);
        if (!$changeEnv['success']) {
            return redirect()->back()->withErrors(['db' => $changeEnv['message']]);
        }

        return redirect()->route('login');
    }
}
