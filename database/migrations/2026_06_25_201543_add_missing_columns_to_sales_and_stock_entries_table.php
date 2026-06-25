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
        // 1. Menambahkan kolom 'type' ke tabel stock_entries
        Schema::table('stock_entries', function (Blueprint $table) {
            // Kita buat defaultnya 'in' (Masuk) agar data lama kamu tidak rusak/error
            $table->enum('type', ['in', 'out'])->default('in')->after('product_id');
        });

        // 2. Menambahkan kolom 'price_at_sale' dan 'invoice_number' ke tabel sales
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('price_at_sale')->nullable()->after('quantity_sold');
            $table->string('invoice_number')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_entries', function (Blueprint $table) {
            $table->dropColumn('type');
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['price_at_sale', 'invoice_number']);
        });
    }
};