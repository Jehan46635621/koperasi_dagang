<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SavingsProduct extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'code',
        'name',
        'type',
        'description',
        'interest_rate',
        'interest_calculation_method',
        'is_interest_earning',
        'minimum_balance',
        'minimum_deposit',
        'minimum_withdrawal',
        'maximum_withdrawal',
        'administration_fee',
        'withdrawal_fee',
        'term_months',
        'early_withdrawal_penalty_rate',
        'is_active',
    ];

    protected $casts = [
        'interest_rate' => 'decimal:2',
        'is_interest_earning' => 'boolean',
        'minimum_balance' => 'decimal:2',
        'minimum_deposit' => 'decimal:2',
        'minimum_withdrawal' => 'decimal:2',
        'maximum_withdrawal' => 'decimal:2',
        'administration_fee' => 'decimal:2',
        'withdrawal_fee' => 'decimal:2',
        'term_months' => 'integer',
        'early_withdrawal_penalty_rate' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code', 'name', 'interest_rate', 'is_active'])
            ->logOnlyDirty();
    }

    // Relationships
    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class);
    }
}
