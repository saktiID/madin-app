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
        Schema::create('ustadzs', function (Blueprint $table) {
            $table->uuid('id')->primary()->index();
            $table->uuid('user_id')->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('no_telepon', 14)->nullable();
            $table->string('nik', 16)->unique();
            $table->enum('gender', ['L', 'P'])->default('L');
            $table->string('alamat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ustadzs');
    }
};
