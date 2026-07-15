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
        Schema::create('cashbooks', function (Blueprint $table) {
            $table->id();
            $table->string('type');        // 'income' (uang masuk) atau 'expense' (uang keluar)
            $table->integer('amount');     // Jumlah uangnya (misal: 18000)
            $table->string('description'); // Keterangan (misal: "Penjualan Kopi Susu" atau "Beli Es Batu")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashbooks');
    }
};
