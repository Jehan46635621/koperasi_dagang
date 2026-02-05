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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('loan_number', 30)->unique();
            $table->foreignId('member_id')->constrained()->onDelete('restrict');
            $table->foreignId('loan_product_id')->constrained()->onDelete('restrict');
            $table->foreignId('branch_id')->constrained()->onDelete('restrict');
            
            // Application Information
            $table->date('application_date');
            $table->decimal('requested_amount', 15, 2);
            $table->integer('requested_term_months');
            $table->text('purpose')->nullable();
            $table->enum('application_source', ['member_portal', 'admin_entry'])->default('admin_entry');
            
            // Approval Information
            $table->date('approval_date')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('approval_notes')->nullable();
            
            // Disbursement Information
            $table->date('disbursement_date')->nullable();
            $table->decimal('disbursed_amount', 15, 2)->nullable(); // May differ from requested
            $table->integer('approved_term_months')->nullable();
            $table->decimal('interest_rate', 5, 2)->nullable(); // Stored at disbursement
            $table->decimal('monthly_payment_amount', 15, 2)->nullable(); // Auto-calculated or manually adjusted
            
            // Fees
            $table->decimal('administration_fee', 15, 2)->default(0);
            $table->decimal('insurance_fee', 15, 2)->default(0);
            
            // Outstanding Balances
            $table->decimal('principal_outstanding', 15, 2)->default(0);
            $table->decimal('interest_outstanding', 15, 2)->default(0);
            $table->decimal('penalty_outstanding', 15, 2)->default(0);
            $table->decimal('total_outstanding', 15, 2)->default(0);
            
            // Payment Tracking
            $table->decimal('total_paid', 15, 2)->default(0);
            $table->integer('payments_made')->default(0);
            $table->integer('payments_remaining')->nullable();
            $table->date('next_payment_date')->nullable();
            $table->date('last_payment_date')->nullable();
            
            // Status
            $table->enum('status', [
                'pending_approval',
                'approved',
                'rejected',
                'disbursed',
                'active',
                'completed',
                'written_off',
                'restructured'
            ])->default('pending_approval');
            
            $table->enum('collectibility', ['current', 'dpd_1_30', 'dpd_31_60', 'dpd_61_90', 'dpd_91_180', 'dpd_over_180'])
                ->default('current'); // Days Past Due classification
            
            $table->date('maturity_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->text('notes')->nullable();
            
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['member_id', 'status']);
            $table->index(['status', 'collectibility']);
            $table->index('disbursement_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
