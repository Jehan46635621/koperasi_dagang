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
        Schema::create('fiscal_periods', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique(); // e.g., "2024-01" for January 2024
            $table->string('name'); // e.g., "Januari 2024"
            $table->integer('year');
            $table->integer('month');
            
            $table->date('start_date');
            $table->date('end_date');
            
            $table->enum('status', ['open', 'closed', 'locked'])->default('open');
            $table->date('closed_date')->nullable();
            $table->foreignId('closed_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
            
            // Unique constraint to prevent duplicate periods
            $table->unique(['year', 'month']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fiscal_periods');
    }
};
