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
        Schema::create('tugas_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_siswa')->references('id')->on('siswa')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_pertemuan')->references('id')->on('pertemuan')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('file_tugas');
            $table->string('status');
            $table->integer('nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tugas_siswa');
    }
};
