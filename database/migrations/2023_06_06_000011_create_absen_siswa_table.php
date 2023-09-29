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
        Schema::create('absen_siswa', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('id_siswa')->references('id')->on('siswa')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_pertemuan')->references('id')->on('pertemuan')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('waktu');
            $table->string('status', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_siswa');
    }
};
