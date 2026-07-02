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
        // 1. Menambahkan kolom 'type' ke tabel stock_entries (Diberi proteksi agar tidak duplikat)
        if (!Schema::hasColumn('stock_entries', 'type')) {
            Schema::table('stock_entries', function (Blueprint $table) {
                $table->enum('type', ['in', 'out'])->default('in')->after('product_id');
            });
        }

        // 2. Menambahkan kolom 'price_at_sale' dan 'invoice_number' ke tabel sales (Diberi proteksi juga)
        Schema::table('sales', function (Blueprint $table) {
            if (!Schema::hasColumn('sales', 'price_at_sale')) {
                $table->integer('price_at_sale')->nullable()->after('quantity_sold');
            }
            if (!Schema::hasColumn('sales', 'invoice_number')) {
                $table->string('invoice_number')->nullable()->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_entries', function (Blueprint $table) {
            if (Schema::hasColumn('stock_entries', 'type')) {
                $table->dropColumn('type');
            }
        });

        Schema::table('sales', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('sales', 'price_at_sale')) {
                $columnsToDrop[] = 'price_at_sale';
            }
            if (Schema::hasColumn('sales', 'invoice_number')) {
                $columnsToDrop[] = 'invoice_number';
            }
            
            if (count($columnsToDrop) > 0) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};