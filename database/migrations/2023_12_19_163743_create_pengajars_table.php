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
        Schema::create('pengajars', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nik', 16);
            $table->string('tempat_lahir', 225);
            $table->string('tanggal_lahir', 25);
            $table->string('pendidikan_terakhir', 125);
            $table->string('pendidikan_islam', 125);
            $table->string('telp', 14);
            $table->string('alamat', 125);
            $table->string('kabupaten', 125);
            $table->string('provinsi', 125);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajars');
    }
};
