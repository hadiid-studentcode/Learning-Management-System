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
        Schema::create('wali_murid', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nik', 25);
            $table->string('nama', 100);
            $table->string('hubungan', 50);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('agama', 50);
            $table->string('no_hp', 20);
            $table->string('kelurahan', 100);
            $table->string('kecamatan', 100);
            $table->string('kabupatenKota', 100);
            $table->string('provinsi', 100);
            $table->string('email', 100)->unique()->nullable();
            $table->string('pekerjaan', 100);
            $table->text('alamat');
            $table->foreignId('id_siswa')->references('id')->on('siswa')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_user')->nullable()->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wali_murid');
    }
};
