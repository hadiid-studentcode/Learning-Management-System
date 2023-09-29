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
        Schema::create('kinerja_guru', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('id_tahun_ajaran')->references('id')->on('tahun_ajaran')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->foreignId('id_guru')->references('id')->on('guru')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->float('poin_absensi')->nullable();
            $table->foreignId('id_pertemuan')->nullable()->references('id')->on('pertemuan')->constrained()->onUpdate('cascade')->onDelete('cascade');

            $table->float('poin_upload_materi')->nullable();
            $table->float('poin_upload_tugas')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kinerja_guru');
    }
};
