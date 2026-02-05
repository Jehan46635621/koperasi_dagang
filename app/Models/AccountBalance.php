<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountBalance extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'fiscal_period_id',
        'opening_balance',
        'debit_amount',
        'credit_amount',
        'closing_balance',
    ];

    protected $casts = [
        'opening_balance' => 'decimal:2',
        'debit_amount' => 'decimal:2',
        'credit_amount' => 'decimal:2',
        'closing_balance' => 'decimal:2',
    ];

    // Relationships
    public function account()
    {
        return $this->belongsTo(ChartOfAccount::class, 'account_id');
    }

    public function fiscalPeriod()
    {
        return $this->belongsTo(FiscalPeriod::class);
    }
}
