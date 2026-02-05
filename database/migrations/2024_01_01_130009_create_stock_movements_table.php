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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->string('movement_number', 30)->unique();
            $table->foreignId('product_id')->constrained()->onDelete('restrict');
            $table->foreignId('branch_id')->constrained()->onDelete('restrict');
            
            $table->date('movement_date');
            $table->enum('type', ['in', 'out', 'adjustment', 'transfer', 'return', 'damage', 'expired']);
            
            $table->integer('quantity');
            $table->integer('quantity_before');
            $table->integer('quantity_after');
            
            // References to source transactions
            $table->morphs('reference'); // Can be sale_id, purchase_order_id, goods_receipt_id, etc.
            
            $table->text('notes')->nullable();
            
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            // Indexes
            $table->index(['product_id', 'movement_date']);
            $table->index(['type', 'branch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
