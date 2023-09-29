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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('id_siswa')->references('id')->on('siswa')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_mapel')->references('id')->on('mapel')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('semester', 3);
            $table->float('nilai_uh');
            $table->float('nilai_tugas');
            $table->float('nilai_uts');
            $table->float('nilai_uas');
            $table->float('nilai_akhir');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
