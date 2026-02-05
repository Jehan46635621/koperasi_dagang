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
        Schema::create('savings_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number', 30)->unique();
            $table->foreignId('savings_account_id')->constrained()->onDelete('restrict');
            $table->date('transaction_date');
            $table->time('transaction_time');
            
            $table->enum('type', ['deposit', 'withdrawal', 'interest', 'fee', 'transfer_in', 'transfer_out', 'opening', 'closing']);
            $table->decimal('amount', 15, 2);
            $table->decimal('balance_before', 15, 2);
            $table->decimal('balance_after', 15, 2);
            
            $table->text('description')->nullable();
            $table->string('reference_number', 50)->nullable(); // External reference
            
            // Journal entry reference
            $table->foreignId('journal_entry_id')->nullable()->constrained()->onDelete('set null');
            
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            // Indexes
            $table->index(['savings_account_id', 'transaction_date']);
            $table->index('transaction_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings_transactions');
    }
};
