<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class InstallerService
{
    public static function testDatabaseConnection($host, $port, $name, $user, $pass)
    {
        config([
            'database.connections.install_check' => [
                'driver' => 'mysql',
                'host' => $host,
                'port' => $port,
                'database' => $name,
                'username' => $user,
                'password' => $pass,
            ],
        ]);

        try {
            DB::connection('install_check')->getPdo();
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public static function updateEnv(array $data)
    {
        $envPath = base_path('.env');
        $examplePath = base_path('.env.example');

        if (!File::exists($envPath)) {
            if (File::exists($examplePath)) {
                File::copy($examplePath, $envPath);
            } else {
                throw new \Exception('.env.example tidak ditemukan');
            }
        }

        $env = File::get($envPath);

        try {
            foreach ($data as $key => $value) {
                $pattern = "/^{$key}=.*/m";
                $line = "{$key}={$value}";
                if (preg_match($pattern, $env)) {
                    $env = preg_replace($pattern, $line, $env);
                } else {
                    $env .= "\n{$line}";
                }
            }
            File::put($envPath, $env);
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public static function setupArtisanCommands()
    {
        try {
            // Pastikan konfigurasi dimuat ulang dari file .env
            Artisan::call('config:clear');
            Artisan::call('cache:clear');
            Artisan::call('key:generate');
            Artisan::call('storage:link');
            Artisan::call('migrate:fresh', ['--seed' => true]);
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
