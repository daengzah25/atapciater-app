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
        Schema::table('pesanan', function (Blueprint $table) {
            // Update enum untuk menambah nilai 'full_cash_on_site'
            $table->enum('metode_bayar', ['dp_50%', 'lunas', 'full_cash_on_site'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            // Rollback ke enum lama
            $table->enum('metode_bayar', ['dp_50%', 'lunas'])->change();
        });
    }
};
