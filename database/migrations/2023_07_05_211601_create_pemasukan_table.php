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
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->string('tanggal');
            $table->string('pembayaran');
            $table->integer('tarif')->nullable();
            $table->integer('nominal');
            $table->integer('sisa')->nullable();
            $table->string('diterima_dari');
            $table->string('metode_pembayaran');
            $table->string('deskripsi');
            $table->string('bukti_transaksi')->nullable();
            $table->foreignId('id_tahun_ajaran')->references('id')->on('tahun_ajaran')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('report', ['Diterima', 'Ditolak', 'Menunggu'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};
