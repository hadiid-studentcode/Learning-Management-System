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
        Schema::create('rekap_nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->references('id')->on('siswa')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_mapel')->references('id')->on('mapel')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->float('total_nilai');
            $table->float('rata_rata');
            $table->text('catatan')->nullable();
            $table->foreignId('id_tahun_ajaran')->references('id')->on('tahun_ajaran')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_nilai_siswa');
    }
};
