<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class SavingsAccount extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'account_number',
        'member_id',
        'savings_product_id',
        'branch_id',
        'opening_date',
        'closing_date',
        'balance',
        'interest_accrued',
        'last_interest_calculation_date',
        'status',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'opening_date' => 'date',
        'closing_date' => 'date',
        'balance' => 'decimal:2',
        'interest_accrued' => 'decimal:2',
        'last_interest_calculation_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['account_number', 'status', 'balance'])
            ->logOnlyDirty();
    }

    // Relationships
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function savingsProduct()
    {
        return $this->belongsTo(SavingsProduct::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function transactions()
    {
        return $this->hasMany(SavingsTransaction::class);
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
        return $query->where('status', 'active');
    }

    // Helper Methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function canWithdraw(float $amount): bool
    {
        $product = $this->savingsProduct;
        
        if ($amount < $product->minimum_withdrawal) {
            return false;
        }
        
        if ($product->maximum_withdrawal && $amount > $product->maximum_withdrawal) {
            return false;
        }
        
        $balanceAfterWithdrawal = $this->balance - $amount;
        
        return $balanceAfterWithdrawal >= $product->minimum_balance;
    }
}
