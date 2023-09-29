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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nama_lengkap', 100);
            $table->string('email')->nullable();
            $table->string('userid', 20)->unique();
            $table->string('password')->nullable();
            $table->enum('hak_akses', ['Super User', 'Guru', 'Wali Murid', 'Pegawai', 'Siswa', 'Tata Usaha']);
            $table->string('foto')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
