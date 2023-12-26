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
        Schema::create('peserta_ppdb', function (Blueprint $table) {
            $table->id();
            // siswa
            $table->string('nisn_siswa', 100)->unique();
            $table->string('nama_siswa', 100);
            $table->string('kelas_siswa', 100);
            $table->enum('jenis_kelamin_siswa', ['Laki-laki', 'Perempuan']);
            $table->string('agama_siswa', 50);
            $table->string('kelurahan_siswa', 50);
            $table->string('kecamatan_siswa', 50);
            $table->string('kabupatenKota_siswa', 50);
            $table->string('provinsi_siswa', 50);
            $table->text('alamat_siswa');
            $table->string('tempat_lahir_siswa', 30);
            $table->date('tanggal_lahir_siswa');
            $table->string('foto_siswa')->nullable();
            // wali murid
            $table->string('nik_wali_murid', 25);
            $table->string('nama_wali_murid', 100);
            $table->string('hubungan_wali_murid', 50);
            $table->enum('jenis_kelamin_wali_murid', ['Laki-laki', 'Perempuan']);
            $table->string('agama_wali_murid', 50);
            $table->string('no_hp_wali_murid', 20);
            $table->string('kelurahan_wali_murid', 100);
            $table->string('kecamatan_wali_murid', 100);
            $table->string('kabupatenKota_wali_murid', 100);
            $table->string('provinsi_wali_murid', 100);
            $table->string('email_wali_murid', 100)->unique()->nullable();
            $table->string('pekerjaan_wali_murid', 100);
            $table->text('alamat_wali_murid');
            $table->boolean('status_ppdb');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_ppdb');
    }
};
