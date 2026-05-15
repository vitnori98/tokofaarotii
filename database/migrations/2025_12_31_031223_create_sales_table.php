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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity_sold');
            // Memberikan nilai default tanggal sekarang
            $table->date('sale_date')->useCurrent(); 
            $table->decimal('total_price', 10, 2);
            $table->timestamps();
            $table->enum('source', ['online', 'offline'])->default('offline');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');
            $table->string('customer_name')->nullable(); // Menyesuaikan controller kamu yang sudah ada customer_name
            $table->text('notes')->nullable(); // Menyesuaikan controller kamu yang sudah ada notes
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};