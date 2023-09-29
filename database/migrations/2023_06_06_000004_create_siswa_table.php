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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nisn', 100)->unique();
            $table->string('nama', 100);
            $table->foreignId('id_kelas')->nullable()->references('id')->on('kelas')->constrained()->onUpdate('cascade')->onDelete('set null');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama', 50);
            $table->string('kelurahan', 50);
            $table->string('kecamatan', 50);
            $table->string('kabupatenKota', 50);
            $table->string('provinsi', 50);
            $table->text('alamat');
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->string('foto')->nullable();
            $table->foreignId('id_user')->nullable()->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
