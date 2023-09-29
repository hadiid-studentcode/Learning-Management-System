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
        Schema::create('absen_guru', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('id_guru')->references('id')->on('guru')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('waktu');
            $table->string('status', 20);
            $table->float('poin_absensi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_guru');
    }
};
