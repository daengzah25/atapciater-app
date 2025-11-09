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
        Schema::create('slot', function (Blueprint $table) {
            $table->id('id_slot');
            $table->foreignId('id_paket')
                ->constrained('daftar_paket', 'id_paket')
                ->onDelete('cascade'); // Tambahkan cascade delete
            $table->date('tanggal');
            $table->integer('slot_tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slot');
    }
};
