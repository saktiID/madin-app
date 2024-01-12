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

            // data akun
            $table->uuid('id')->primary();
            $table->string('avatar');

            // data santri
            $table->string('nama_santri', 125);
            $table->string('nis', 16); // nism (nomor induk santri madrasah)
            $table->string('no_kk', 16)->nullable();
            $table->string('nik', 16);
            $table->string('nama_kepala_keluarga', 125)->nullable();
            $table->string('gender', 12);
            $table->string('tempat_lahir', 25);
            $table->string('tanggal_lahir', 25);
            $table->string('jumlah_saudara', 2)->nullable();
            $table->string('anak_ke', 2)->nullable();
            $table->string('cita_cita', 125)->nullable();
            $table->string('hobi', 125)->nullable();
            $table->string('telp', 14)->nullable();
            $table->string('email', 125)->nullable();
            $table->enum('pembiaya', ['Orang tua', 'Wali/Orang tua asuh', 'Tanggungan sendiri', 'Lainnya'])->nullable(); // ['Orang tua', 'Wali/Orang tua asuh', 'Tanggungan sendiri', 'lainnya']
            $table->enum('kebutuhan_khusus', ['Tidak ada', 'Lamban belajar', 'Kesulitan belajar spesifik', 'Gangguan komunikasi', 'Berbakat/Memiliki kemampuan dan kecerdasan luar biasa', 'Lainnya'])->nullable(); // ['Tidak ada', 'Lamban belajar', 'Kesulitan belajar spesifik', 'Gangguan komunikasi', 'Berbakat/Memiliki kemampuan dan kecerdasan luar biasa', 'lainnya']
            $table->enum('kebutuhan_disabilitas', ['Tidak ada', 'Tuna netra', 'Tuna rungu', 'Tuna daksa', 'Tuna grahita', 'Tuna laras', 'Lainnya'])->nullable(); // ['Tidak ada', 'Tuna netra', 'Tuna rungu', 'Tuna daksa', 'Tuna grahita', 'Tuna laras', 'Lainnya']

            // data orang tua
            $table->string('nama_ayah', 125)->nullable();
            $table->enum('status_ayah', ['Masih hidup', 'Sudah meninggal', 'Tidak diketahui'])->nullable();
            $table->enum('kewaraganegaraan_ayah', ['WNI', 'WNA'])->nullable();
            $table->string('nik_ayah', 16)->nullable();
            $table->string('tempat_lahir_ayah', 25)->nullable();
            $table->string('tanggal_lahir_ayah', 25)->nullable();
            $table->string('pendidikan_terakhir_ayah', 125)->nullable();
            $table->string('pekerjaan_ayah', 125)->nullable();
            $table->enum('penghasilan_ayah', ['Kurang dari 500.000', '500.000 - 1.000.000', '1.000.000 - 2.000.000', '2.000.000 - 3.000.000', '3.000.000 - 5.000.000', ' Lebih dari 5.000.000'])->nullable();
            $table->string('telp_ayah', 14)->nullable();

            $table->string('nama_ibu', 125)->nullable();
            $table->enum('status_ibu', ['Masih hidup', 'Sudah meninggal', 'Tidak diketahui'])->nullable();
            $table->enum('kewaraganegaraan_ibu', ['WNI', 'WNA'])->nullable();
            $table->string('nik_ibu', 16)->nullable();
            $table->string('tempat_lahir_ibu', 25)->nullable();
            $table->string('tanggal_lahir_ibu', 25)->nullable();
            $table->string('pendidikan_terakhir_ibu', 125)->nullable();
            $table->string('pekerjaan_ibu', 125)->nullable();
            $table->string('penghasilan_ibu', 125)->nullable();
            $table->string('telp_ibu', 14)->nullable();

            // data alamat
            $table->string('alamat', 125);
            $table->string('rt', 4)->nullable();
            $table->string('rw', 4)->nullable();
            $table->string('kelurahan', 125)->nullable();
            $table->string('kode_pos', 6)->nullable();
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
