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
        Schema::create('kelas_santris', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('periode_id')->index();
            $table->foreign('periode_id')->references('id')->on('periodes')->onDelete('cascade');
            $table->uuid('kelas_id')->index();
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->uuid('santri_id')->index();
            $table->foreign('santri_id')->references('id')->on('santris')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_santris');
    }
};
