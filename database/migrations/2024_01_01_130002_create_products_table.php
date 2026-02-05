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
            $table->string('sku', 50)->unique();
            $table->string('barcode', 100)->nullable()->unique();
            $table->string('name');
            $table->foreignId('category_id')->constrained('product_categories')->onDelete('restrict');
            $table->text('description')->nullable();
            
            // Pricing
            $table->decimal('purchase_price', 15, 2)->default(0);
            $table->decimal('selling_price', 15, 2);
            $table->decimal('member_price', 15, 2)->nullable(); // Special price for members
            $table->decimal('wholesale_price', 15, 2)->nullable();
            
            // Inventory
            $table->string('unit', 20)->default('pcs'); // pcs, kg, liter, box, etc.
            $table->integer('stock_quantity')->default(0);
            $table->integer('minimum_stock')->default(0); // Reorder point
            $table->integer('maximum_stock')->nullable();
            
            // Dimensions (optional)
            $table->decimal('weight', 10, 3)->nullable(); // in kg
            $table->decimal('length', 10, 2)->nullable(); // in cm
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('height', 10, 2)->nullable();
            
            // Tax
            $table->boolean('is_taxable')->default(false);
            $table->decimal('tax_rate', 5, 2)->default(0);
            
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('category_id');
            $table->index(['is_active', 'category_id']);
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
