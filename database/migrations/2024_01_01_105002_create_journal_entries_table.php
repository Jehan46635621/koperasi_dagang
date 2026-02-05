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
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();
            $table->string('journal_number', 30)->unique();
            $table->foreignId('fiscal_period_id')->constrained()->onDelete('restrict');
            $table->foreignId('branch_id')->constrained()->onDelete('restrict');
            
            $table->date('entry_date');
            $table->date('posting_date')->nullable();
            
            $table->enum('entry_type', [
                'general',
                'sales',
                'purchase',
                'payment',
                'receipt',
                'savings',
                'loan',
                'adjustment',
                'closing'
            ])->default('general');
            
            $table->decimal('total_debit', 15, 2)->default(0);
            $table->decimal('total_credit', 15, 2)->default(0);
            
            $table->text('description');
            $table->text('notes')->nullable();
            
            // Source reference (polymorphic)
            $table->morphs('source'); // Can be sale_id, loan_id, savings_transaction_id, etc.
            
            $table->enum('status', ['draft', 'posted', 'approved', 'reversed'])->default('draft');
            $table->boolean('is_auto_generated')->default(false); // Auto from transactions vs manual entry
            
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('posted_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->foreignId('reversed_entry_id')->nullable()->constrained('journal_entries')->onDelete('set null');
            $table->date('reversed_date')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['entry_date', 'status']);
            $table->index(['fiscal_period_id', 'entry_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
