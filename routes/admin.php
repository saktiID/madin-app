<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IdentitasController;
use App\Http\Controllers\Admin\DataSantriController;
use App\Http\Controllers\Admin\DataAsatidzController;

Route::prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::get('/identitas', [IdentitasController::class, 'index'])->name('admin.identitas.index');
    Route::post('/upload-logo', [IdentitasController::class, 'uploadLogo'])->name('admin.upload.logo');
    Route::patch('/identitas/update', [IdentitasController::class, 'update'])->name('admin.identitas.update');

    Route::prefix('master-data')->group(function () {
        Route::prefix('data-asatidz')->group(function () {
            Route::get('/', [DataAsatidzController::class, 'index'])->name('admin.master-data.data-asatidz.index');
            Route::get('/create', [DataAsatidzController::class, 'create'])->name('admin.master-data.data-asatidz.create');
            Route::get('/upload', [DataAsatidzController::class, 'upload'])->name('admin.master-data.data-asatidz.upload');
            Route::get('/parsing', [DataAsatidzController::class, 'parsing'])->name('admin.master-data.data-asatidz.parsing');
            Route::get('/polling', [DataAsatidzController::class, 'polling'])->name('admin.master-data.data-asatidz.polling');
            Route::get('/download', [DataAsatidzController::class, 'download'])->name('admin.master-data.data-asatidz.download');
            Route::get('/download-template', [DataAsatidzController::class, 'download_template'])->name('admin.master-data.data-asatidz.download-template');
            Route::get('/export', [DataAsatidzController::class, 'export'])->name('admin.master-data.data-asatidz.export');
            Route::get('/{id}', [DataAsatidzController::class, 'edit'])->name('admin.master-data.data-asatidz.edit');
            Route::post('/', [DataAsatidzController::class, 'store'])->name('admin.master-data.data-asatidz.store');
            Route::post('/upload', [DataAsatidzController::class, 'upload_file'])->name('admin.master-data.data-asatidz.upload-file');
            Route::post('/updateAvatar', [DataAsatidzController::class, 'updateAvatar'])->name('admin.master-data.data-asatidz.updateAvatar');
            Route::patch('/updateProfile', [DataAsatidzController::class, 'updateProfile'])->name('admin.master-data.data-asatidz.updateProfile');
            Route::patch('/updateUstadz', [DataAsatidzController::class, 'updateUstadz'])->name('admin.master-data.data-asatidz.updateUstadz');
            Route::patch('/updatePassword', [DataAsatidzController::class, 'updatePassword'])->name('admin.master-data.data-asatidz.updatePassword');
            Route::delete('/delete', [DataAsatidzController::class, 'destroy'])->name('admin.master-data.data-asatidz.delete');
            Route::delete('/delete-file', [DataAsatidzController::class, 'delete_file'])->name('admin.master-data.data-asatidz.delete-file');
        });

        Route::prefix('data-santri')->group(function () {
            Route::get('/', [DataSantriController::class, 'index'])->name('admin.master-data.data-santri.index');
            Route::delete('/delete', [DataSantriController::class, 'destroy'])->name('admin.master-data.data-santri.delete');
        });
    });
});
