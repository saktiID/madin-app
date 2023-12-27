<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\FotoGetterController;
use App\Http\Controllers\PeriodeSetterController;
use App\Http\Controllers\Admin\IdentitasController;
use App\Http\Controllers\Admin\DataSantriController;
use App\Http\Controllers\Admin\DataAsatidzController;
use App\Http\Controllers\Admin\DataPelajaranController;

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
    Route::get('get-foto/{filename}', [FotoGetterController::class, 'foto'])->name('get-foto');
    Route::get('set-periode', [PeriodeSetterController::class, 'setCurrentPeriode'])->name('set-periode');
    Route::get('beranda', [BerandaController::class, 'index'])->name('beranda');

    Route::get('identitas', [IdentitasController::class, 'index'])->name('identitas');
    Route::post('identitas/edit', [IdentitasController::class, 'edit'])->name('simpan-setting-identitas');
    Route::post('identitas/logo', [IdentitasController::class, 'logo'])->name('simpan-logo');

    Route::prefix('master-data')->group(function () {
        Route::get('/', function () {
            return redirect()->route('beranda');
        });
        Route::get('/data-asatidz', [DataAsatidzController::class, 'index'])->name('data-asatidz');
        Route::get('/data-asatidz/{id}', [DataAsatidzController::class, 'detail'])->name('profile-asatidz');
        Route::post('/data-asatidz/tambah', [DataAsatidzController::class, 'tambah'])->name('tambah-asatidz');
        Route::post('/data-asatidz/edit/credential', [DataAsatidzController::class, 'editCredential'])->name('edit-credential-asatidz');
        Route::post('/data-asatidz/edit/biodata', [DataAsatidzController::class, 'editBiodata'])->name('edit-biodata-asatidz');
        Route::post('/data-asatidz/foto', [DataAsatidzController::class, 'foto'])->name('foto-asatidz');
        Route::post('/data-asatidz/hapus', [DataAsatidzController::class, 'hapus'])->name('hapus-asatidz');

        Route::get('/data-santri', [DataSantriController::class, 'index'])->name('data-santri');
        Route::get('/data-santri/{id}', [DataSantriController::class, 'detail'])->name('profile-santri');
        Route::post('/data-santri/tambah', [DataSantriController::class, 'tambah'])->name('tambah-santri');
        Route::post('/data-santri/edit', [DataSantriController::class, 'edit'])->name('edit-santri');
        Route::post('/data-santri/foto', [DataSantriController::class, 'foto'])->name('foto-santri');
        Route::post('/data-santri/hapus', [DataSantriController::class, 'hapus'])->name('hapus-santri');

        Route::get('/data-pelajaran', [DataPelajaranController::class, 'index'])->name('data-pelajaran');

        Route::get('/data-kelas', [DataAsatidzController::class, 'index'])->name('data-kelas');
        Route::get('/data-periode', [DataAsatidzController::class, 'index'])->name('data-periode');
    });

    Route::get('raport/kelas/{id}', [DataAsatidzController::class, 'index'])->name('raport-kelas');

    Route::get('log', [BerandaController::class, 'index'])->name('log');


    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
