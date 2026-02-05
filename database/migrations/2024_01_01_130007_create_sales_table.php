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
            $table->string('invoice_number', 30)->unique();
            $table->foreignId('branch_id')->constrained()->onDelete('restrict');
            $table->foreignId('member_id')->nullable()->constrained()->onDelete('set null'); // Null for non-member sales
            
            $table->date('sale_date');
            $table->time('sale_time');
            
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('tax_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            
            $table->enum('payment_method', ['cash', 'transfer', 'credit', 'member_account'])->default('cash');
            $table->enum('payment_status', ['paid', 'partial', 'unpaid'])->default('paid');
            $table->decimal('amount_paid', 15, 2)->default(0);
            $table->decimal('change_amount', 15, 2)->default(0);
            
            $table->boolean('is_member_sale')->default(false);
            $table->decimal('member_discount_percent', 5, 2)->default(0);
            
            $table->text('notes')->nullable();
            
            // Journal entry reference
            $table->foreignId('journal_entry_id')->nullable()->constrained()->onDelete('set null');
            
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            // Indexes
            $table->index(['sale_date', 'branch_id']);
            $table->index('member_id');
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
