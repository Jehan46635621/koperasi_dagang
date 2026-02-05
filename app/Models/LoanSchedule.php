<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'installment_number',
        'due_date',
        'principal_amount',
        'interest_amount',
        'total_amount',
        'principal_paid',
        'interest_paid',
        'penalty_paid',
        'total_paid',
        'principal_outstanding',
        'interest_outstanding',
        'balance_after_payment',
        'status',
        'payment_date',
        'days_overdue',
    ];

    protected $casts = [
        'due_date' => 'date',
        'principal_amount' => 'decimal:2',
        'interest_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'principal_paid' => 'decimal:2',
        'interest_paid' => 'decimal:2',
        'penalty_paid' => 'decimal:2',
        'total_paid' => 'decimal:2',
        'principal_outstanding' => 'decimal:2',
        'interest_outstanding' => 'decimal:2',
        'balance_after_payment' => 'decimal:2',
        'payment_date' => 'date',
        'days_overdue' => 'integer',
    ];

    // Relationships
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }

    // Helper Methods
    public function isOverdue(): bool
    {
        return $this->status === 'overdue' || 
               ($this->due_date < now() && $this->status !== 'paid');
    }

    public function getRemainingAmount(): float
    {
        return $this->total_amount - $this->total_paid;
    }
}
