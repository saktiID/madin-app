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
        Schema::create('kelas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('periode_id');
            // $table->foreign('periode_id')->references('id')->on('periodes');
            $table->string('nama_kelas', 25);
            $table->string('bagian_kelas', 2);
            $table->string('jenjang_kelas', 2);
            $table->string('mustahiq_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
