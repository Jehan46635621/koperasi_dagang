<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_number',
        'member_id',
        'loan_product_id',
        'branch_id',
        'application_date',
        'requested_amount',
        'requested_term_months',
        'purpose',
        'application_source',
        'approval_date',
        'approved_by',
        'approval_notes',
        'disbursement_date',
        'disbursed_amount',
        'approved_term_months',
        'interest_rate',
        'monthly_payment_amount',
        'administration_fee',
        'insurance_fee',
        'principal_outstanding',
        'interest_outstanding',
        'penalty_outstanding',
        'total_outstanding',
        'total_paid',
        'payments_made',
        'payments_remaining',
        'next_payment_date',
        'last_payment_date',
        'status',
        'collectibility',
        'maturity_date',
        'completion_date',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'application_date' => 'date',
        'approval_date' => 'date',
        'disbursement_date' => 'date',
        'requested_amount' => 'decimal:2',
        'disbursed_amount' => 'decimal:2',
        'interest_rate' => 'decimal:2',
        'monthly_payment_amount' => 'decimal:2',
        'administration_fee' => 'decimal:2',
        'insurance_fee' => 'decimal:2',
        'principal_outstanding' => 'decimal:2',
        'interest_outstanding' => 'decimal:2',
        'penalty_outstanding' => 'decimal:2',
        'total_outstanding' => 'decimal:2',
        'total_paid' => 'decimal:2',
        'next_payment_date' => 'date',
        'last_payment_date' => 'date',
        'maturity_date' => 'date',
        'completion_date' => 'date',
    ];

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function loanProduct()
    {
        return $this->belongsTo(LoanProduct::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function schedules()
    {
        return $this->hasMany(LoanSchedule::class);
    }

    public function payments()
    {
        return $this->hasMany(LoanPayment::class);
    }

    public function collaterals()
    {
        return $this->hasMany(LoanCollateral::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['disbursed', 'active']);
    }

    public function scopePendingApproval($query)
    {
        return $query->where('status', 'pending_approval');
    }

    public function scopeOverdue($query)
    {
        return $query->where('collectibility', '!=', 'current')
            ->whereIn('status', ['disbursed', 'active']);
    }

    // Helper Methods
    public function isPendingApproval(): bool
    {
        return $this->status === 'pending_approval';
    }

    public function isActive(): bool
    {
        return in_array($this->status, ['disbursed', 'active']);
    }

    public function isOverdue(): bool
    {
        return $this->collectibility !== 'current' && $this->isActive();
    }

    public function getDaysOverdue(): int
    {
        if (!$this->next_payment_date || $this->next_payment_date->isFuture()) {
            return 0;
        }

        return now()->diffInDays($this->next_payment_date);
    }
}
