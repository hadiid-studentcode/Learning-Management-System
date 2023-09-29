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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nik')->unique();
            $table->string('nama', 50);
            $table->string('jenis', 50);
            $table->string('no_hp', 20);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama', 20);
            $table->enum('status_perkawinan', ['Belum Menikah', 'Menikah', 'Cerai']);
            $table->string('kelurahan', 50);
            $table->string('kecamatan', 50);
            $table->string('kabupatenKota', 50);
            $table->string('provinsi', 50);
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->foreignId('id_user')->nullable()->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
