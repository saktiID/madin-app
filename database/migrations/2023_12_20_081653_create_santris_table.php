<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_santri', 125);
            $table->string('avatar');
            $table->string('nis', 16);
            $table->string('nik', 16);
            $table->string('gender', 12);
            $table->string('tempat_lahir', 25);
            $table->string('tanggal_lahir', 25);
            $table->string('alamat', 125);
            $table->string('kabupaten', 25);
            $table->string('provinsi', 25);
            $table->string('tahun_masuk', 5)->nullable();
            $table->string('tahun_keluar', 5)->nullable();
            $table->string('tahun_lulus', 5)->nullable();
            $table->boolean('is_active', true)->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
