<?php

use App\Http\Controllers\Admin\DataAsatidzController;
use App\Http\Controllers\Admin\IdentitasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\PeriodeSetterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.auth');
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('set-periode', [PeriodeSetterController::class, 'setCurrentPeriode'])->name('set-periode');
    Route::get('beranda', [BerandaController::class, 'index'])->name('beranda');

    Route::get('identitas', [IdentitasController::class, 'index'])->name('identitas');
    Route::post('identitas', [IdentitasController::class, 'simpanSetting'])->name('simpan-setting-identitas');
    Route::post('logo', [IdentitasController::class, 'simpanLogo'])->name('simpan-logo');

    Route::get('log', [BerandaController::class, 'index'])->name('log');

    Route::prefix('master-data')->group(function () {
        Route::get('/', function () {
            return redirect()->route('beranda');
        });
        Route::get('/data-asatidz', [DataAsatidzController::class, 'index'])->name('data-asatidz');
        Route::get('/data-santri', [DataAsatidzController::class, 'index'])->name('data-santri');
        Route::get('/data-pelajaran', [DataAsatidzController::class, 'index'])->name('data-pelajaran');
        Route::get('/data-kelas', [DataAsatidzController::class, 'index'])->name('data-kelas');
        Route::get('/data-periode', [DataAsatidzController::class, 'index'])->name('data-periode');
    });

    Route::get('raport/kelas/{id}', [DataAsatidzController::class, 'index'])->name('raport-kelas');


    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
