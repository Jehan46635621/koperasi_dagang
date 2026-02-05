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
        Schema::create('savings_products', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->enum('type', ['pokok', 'wajib', 'sukarela', 'berjangka']); // principal, mandatory, voluntary, time deposit
            $table->text('description')->nullable();
            
            // Interest Configuration
            $table->decimal('interest_rate', 5, 2)->default(0); // Annual percentage
            $table->enum('interest_calculation_method', ['daily', 'monthly', 'annually'])->default('monthly');
            $table->boolean('is_interest_earning')->default(true);
            
            // Limits
            $table->decimal('minimum_balance', 15, 2)->default(0);
            $table->decimal('minimum_deposit', 15, 2)->default(0);
            $table->decimal('minimum_withdrawal', 15, 2)->default(0);
            $table->decimal('maximum_withdrawal', 15, 2)->nullable();
            
            // Fees
            $table->decimal('administration_fee', 15, 2)->default(0);
            $table->decimal('withdrawal_fee', 15, 2)->default(0);
            
            // Time Deposit specific
            $table->integer('term_months')->nullable(); // for time deposits
            $table->decimal('early_withdrawal_penalty_rate', 5, 2)->nullable();
            
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
        Schema::dropIfExists('savings_products');
    }
};
