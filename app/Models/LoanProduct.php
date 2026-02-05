<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'type',
        'description',
        'interest_rate',
        'interest_calculation_method',
        'minimum_amount',
        'maximum_amount',
        'minimum_term_months',
        'maximum_term_months',
        'administration_fee_rate',
        'insurance_fee_rate',
        'late_payment_penalty_rate',
        'late_payment_fine_amount',
        'requires_collateral',
        'collateral_requirements',
        'requires_committee_approval',
        'max_approval_days',
        'is_active',
    ];

    protected $casts = [
        'interest_rate' => 'decimal:2',
        'minimum_amount' => 'decimal:2',
        'maximum_amount' => 'decimal:2',
        'administration_fee_rate' => 'decimal:2',
        'insurance_fee_rate' => 'decimal:2',
        'late_payment_penalty_rate' => 'decimal:2',
        'late_payment_fine_amount' => 'decimal:2',
        'requires_collateral' => 'boolean',
        'requires_committee_approval' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
