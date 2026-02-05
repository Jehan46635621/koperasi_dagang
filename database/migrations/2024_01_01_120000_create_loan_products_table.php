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
        Schema::create('loan_products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->enum('type', ['productive', 'consumptive', 'emergency', 'vehicle', 'housing'])->default('consumptive');
            $table->text('description')->nullable();
            
            // Interest Configuration
            $table->decimal('interest_rate', 5, 2); // Annual percentage
            $table->enum('interest_calculation_method', ['flat', 'effective', 'declining_balance'])->default('flat');
            
            // Loan Limits
            $table->decimal('minimum_amount', 15, 2)->default(0);
            $table->decimal('maximum_amount', 15, 2)->nullable();
            $table->integer('minimum_term_months')->default(1);
            $table->integer('maximum_term_months')->default(60);
            
            // Fees and Penalties
            $table->decimal('administration_fee_rate', 5, 2)->default(0); // Percentage of loan amount
            $table->decimal('insurance_fee_rate', 5, 2)->default(0);
            $table->decimal('late_payment_penalty_rate', 5, 2)->default(0); // Per day
            $table->decimal('late_payment_fine_amount', 15, 2)->default(0); // Fixed amount
            
            // Collateral Requirements
            $table->boolean('requires_collateral')->default(false);
            $table->text('collateral_requirements')->nullable();
            
            // Approval Requirements
            $table->boolean('requires_committee_approval')->default(true);
            $table->integer('max_approval_days')->default(7);
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_products');
    }
};
