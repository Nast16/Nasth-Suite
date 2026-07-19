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
        Schema::table('organizations', function (Blueprint $table) {
            // Menambahkan kontrol aktif/nonaktif fitur secara modular
            $table->boolean('has_inventory')->default(true)->after('type');
            $table->boolean('has_cashbook')->default(true)->after('has_inventory');
            $table->boolean('has_tasks')->default(true)->after('has_cashbook');
        });
    }

    public function down(): void
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn(['has_inventory', 'has_cashbook', 'has_tasks']);
        });
    }
};
