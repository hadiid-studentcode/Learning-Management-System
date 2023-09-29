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
        Schema::create('mapel', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('kode');
            $table->string('nama');
            $table->string('hari');
            $table->integer('KKM')->nullable();
            $table->time('waktu_mulai');
            $table->time('waktu_selesai');
            $table->foreignId('id_guru')->references('id')->on('guru')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_kelas')->references('id')->on('kelas')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_tahun_ajaran')->references('id')->on('tahun_ajaran')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapel');
    }
};
