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
        Schema::create('daftar_paket', function (Blueprint $table) {
            $table->id('id_paket');
            $table->string('nama_paket');
            $table->integer('slot');
            $table->text('deskripsi');
            $table->text('fasilitas');
            $table->integer('harga');
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->softDeletes(); // untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_paket');
    }
};
