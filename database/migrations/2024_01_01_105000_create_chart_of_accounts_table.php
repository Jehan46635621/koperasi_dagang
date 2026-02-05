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
        Schema::create('chart_of_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_code', 20)->unique();
            $table->string('account_name');
            $table->enum('account_type', ['asset', 'liability', 'equity', 'revenue', 'expense']); 
            $table->enum('account_category', [
                'current_asset',
                'fixed_asset',
                'current_liability',
                'long_term_liability',
                'equity',
                'operating_revenue',
                'non_operating_revenue',
                'operating_expense',
                'non_operating_expense'
            ]);
            
            $table->foreignId('parent_id')->nullable()->constrained('chart_of_accounts')->onDelete('set null');
            $table->integer('level')->default(1); // Account hierarchy level
            
            $table->enum('normal_balance', ['debit', 'credit']);
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->decimal('current_balance', 15, 2)->default(0);
            
            $table->boolean('is_cash_account')->default(false);
            $table->boolean('is_bank_account')->default(false);
            $table->boolean('is_header')->default(false); // Header accounts can't have transactions
            $table->boolean('is_active')->default(true);
            
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['account_type', 'is_active']);
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chart_of_accounts');
    }
};
