<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InstallerService;
use Illuminate\Support\Facades\Artisan;

class InstallController extends Controller
{
    public function show()
    {
        return view('installer.index');
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

        return redirect()->route('install.show')->with('success', 'Berhasil test koneksi database.');
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
