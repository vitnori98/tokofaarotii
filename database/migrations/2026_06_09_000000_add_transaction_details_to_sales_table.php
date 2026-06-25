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
        Schema::table('sales', function (Blueprint $table) {
            // tambahkan kolom transaction_group dan payment_method jika belum ada
            if (!Schema::hasColumn('sales', 'transaction_group')) {
                $table->string('transaction_group')->nullable()->after('id');
            }
            if (!Schema::hasColumn('sales', 'payment_method')) {
                $table->string('payment_method')->default('tunai')->after('id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn(['transaction_group', 'payment_method']);
        });
    }
};
