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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');         // Nama produk, misal: Cappuccino
            $table->integer('price');        // Harga produk, misal: 25000
            $table->integer('stock');        // Stok produk, misal: 50
            $table->timestamps();            // Otomatis mencatat waktu dibuat/diedit
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
