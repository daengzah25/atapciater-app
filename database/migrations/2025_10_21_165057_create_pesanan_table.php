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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->integer('id_pesanan')->primary(); // 6 digit acak
            $table->string('nama_pemesan');
            $table->dateTime('tanggal_pesan');
            $table->date('tanggal_booking');
            $table->text('catatan')->nullable();
            $table->integer('total');
            $table->string('no_wa');
            $table->string('screenshot')->nullable();
            $table->enum('status', ['menunggu_konfirmasi', 'dikonfirmasi', 'dibatalkan', 'selesai'])->default('menunggu_konfirmasi');
            $table->enum('metode_bayar', ['dp_50%', 'lunas']);
            $table->string('nama_paket');
            $table->integer('harga_paket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
