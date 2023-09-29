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
        Schema::create('pertemuan', function (Blueprint $table) {
            $table->id();
            $table->string('pertemuan_ke');
            $table->foreignId('id_mapel')->nullable()->references('id')->on('mapel')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama_materi')->nullable();
            $table->text('deskripsi_materi')->nullable();
            $table->string('file_materi')->nullable();
            $table->date('tanggal_materi')->nullable();

            $table->string('nama_tugas')->nullable();
            $table->text('deskripsi_tugas')->nullable();
            $table->string('file_tugas')->nullable();
            $table->dateTime('tanggal_tugas')->nullable();
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
        Schema::dropIfExists('pertemuan');
    }
};
