<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('libur', function (Blueprint $table) {
            $table->id('id_libur');
            $table->date('tanggal');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->unique('tanggal'); // Pastikan tanggal unik
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('libur');
    }
};
