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
        Schema::create('loan_payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_number', 30)->unique();
            $table->foreignId('loan_id')->constrained()->onDelete('restrict');
            $table->foreignId('loan_schedule_id')->nullable()->constrained()->onDelete('set null');
            
            $table->date('payment_date');
            $table->time('payment_time');
            
            $table->decimal('principal_amount', 15, 2)->default(0);
            $table->decimal('interest_amount', 15, 2)->default(0);
            $table->decimal('penalty_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);
            
            $table->enum('payment_method', ['cash', 'transfer', 'deduction', 'payroll'])->default('cash');
            $table->string('reference_number', 50)->nullable();
            $table->text('notes')->nullable();
            
            // Journal entry reference
            $table->foreignId('journal_entry_id')->nullable()->constrained()->onDelete('set null');
            
            // For HCMS payroll deductions
            $table->string('payroll_period', 20)->nullable();
            $table->date('payroll_date')->nullable();
            
            $table->foreignId('processed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            // Indexes
            $table->index(['loan_id', 'payment_date']);
            $table->index('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_payments');
    }
};
