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
        Schema::create('savings_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number', 30)->unique();
            $table->foreignId('member_id')->constrained()->onDelete('restrict');
            $table->foreignId('savings_product_id')->constrained()->onDelete('restrict');
            $table->foreignId('branch_id')->constrained()->onDelete('restrict');
            
            $table->date('opening_date');
            $table->date('closing_date')->nullable();
            
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('interest_accrued', 15, 2)->default(0); // Accumulated but not posted interest
            $table->date('last_interest_calculation_date')->nullable();
            
            $table->enum('status', ['active', 'dormant', 'closed', 'blocked'])->default('active');
            $table->text('notes')->nullable();
            
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['member_id', 'savings_product_id']);
            $table->index(['status', 'branch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings_accounts');
    }
};
