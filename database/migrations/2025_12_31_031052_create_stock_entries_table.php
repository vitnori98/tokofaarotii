<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['in', 'out'])->default('in'); // ← tambahkan ini
            $table->string('supplier')->nullable();              // ← tambahkan ini
            $table->text('notes')->nullable();                   // ← tambahkan ini
            $table->integer('quantity');
            $table->date('entry_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('stock_entries', function (Blueprint $table) {
            $columns = ['type', 'supplier', 'notes', 'entry_date'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('stock_entries', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};