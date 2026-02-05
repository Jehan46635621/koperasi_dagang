<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number',
        'loan_id',
        'loan_schedule_id',
        'payment_date',
        'payment_time',
        'principal_amount',
        'interest_amount',
        'penalty_amount',
        'total_amount',
        'payment_method',
        'reference_number',
        'notes',
        'journal_entry_id',
        'payroll_period',
        'payroll_date',
        'processed_by',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'principal_amount' => 'decimal:2',
        'interest_amount' => 'decimal:2',
        'penalty_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'payroll_date' => 'date',
    ];

    // Relationships
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function loanSchedule()
    {
        return $this->belongsTo(LoanSchedule::class);
    }

    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    // Helper Methods
    public function isPayrollDeduction(): bool
    {
        return $this->payment_method === 'payroll' || $this->payment_method === 'deduction';
    }
}
