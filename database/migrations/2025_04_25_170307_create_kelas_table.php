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
            $table->uuid('id')->primary()->index();
            $table->uuid('periode_id')->index();
            $table->foreign('periode_id')->references('id')->on('periodes')->onDelete('cascade');
            $table->uuid('mustahiq_id')->nullable();
            $table->foreign('mustahiq_id')->references('id')->on('ustadzs')->onDelete('cascade');
            $table->unsignedTinyInteger('jenjang');
            $table->string('nama_kelas');
            $table->string('bagian_kelas');
            $table->timestamps();
            $table->softDeletes();
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
