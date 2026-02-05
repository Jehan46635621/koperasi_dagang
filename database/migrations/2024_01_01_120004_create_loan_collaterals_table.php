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
        Schema::create('loan_collaterals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loan_id')->constrained()->onDelete('cascade');
            
            $table->enum('type', ['vehicle', 'property', 'certificate', 'gold', 'electronics', 'other']);
            $table->string('description');
            $table->decimal('estimated_value', 15, 2);
            
            $table->string('document_number', 100)->nullable();
            $table->date('document_date')->nullable();
            $table->text('details')->nullable(); // JSON or text with specific details
            
            $table->enum('status', ['held', 'returned', 'executed'])->default('held');
            $table->date('return_date')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_collaterals');
    }
};
