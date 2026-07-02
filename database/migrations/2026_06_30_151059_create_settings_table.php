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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('store_name')->default('TOKO FAA');
            $table->string('store_whatsapp')->nullable();
            $table->string('store_email')->nullable();
            $table->text('store_address')->nullable();
            $table->string('store_tagline')->default('Frozen Food & Bakery');
            $table->string('store_logo')->nullable();
            $table->string('footer_text')->default('© 2026 TOKO FAA. All Rights Reserved.');
            $table->boolean('maintenance_mode')->default(0); // 0 = Normal, 1 = Maintenance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
