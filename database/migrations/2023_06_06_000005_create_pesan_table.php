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
        Schema::create('pesan', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('perihal', 200);
            $table->foreignId('id_pengirim')->references('id')->on('users')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('penerima', 100);
            $table->integer('id_penerima')->nullable();
            $table->text('isi_pesan');
            $table->enum('status', ['Pesan Belum Dibaca', 'Pesan Sudah Dibaca']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesan');
    }
};
