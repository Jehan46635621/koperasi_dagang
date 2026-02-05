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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_number', 20)->unique();
            $table->foreignId('member_type_id')->constrained()->onDelete('restrict');
            $table->foreignId('branch_id')->constrained()->onDelete('restrict');
            
            // Personal Information
            $table->string('full_name');
            $table->string('nik', 20)->unique()->nullable(); // Indonesian ID number
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('postal_code', 10)->nullable();
            
            // Employment Information
            $table->string('employer_name', 200)->nullable();
            $table->string('employer_address')->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('employee_id', 50)->nullable(); // For HCMS integration
            
            // Emergency Contact
            $table->string('emergency_contact_name', 200)->nullable();
            $table->string('emergency_contact_phone', 20)->nullable();
            $table->string('emergency_contact_relation', 50)->nullable();
            
            // Membership Status
            $table->date('join_date');
            $table->date('resign_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'resigned', 'suspended'])->default('active');
            $table->text('resign_reason')->nullable();
            
            // Financial
            $table->decimal('simpanan_pokok_paid', 15, 2)->default(0);
            $table->decimal('simpanan_wajib_balance', 15, 2)->default(0);
            
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['status', 'branch_id']);
            $table->index('employee_id'); // For HCMS integration
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
