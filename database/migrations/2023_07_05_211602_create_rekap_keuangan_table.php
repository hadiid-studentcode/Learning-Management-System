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
        Schema::create('rekap_keuangan', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pemasukan')->nullable()->references('id')->on('pemasukan')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pengeluaran')->nullable()->references('id')->on('pengeluaran')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('jenis', ['Pemasukan', 'Pengeluaran']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_keuangan');
    }
};
