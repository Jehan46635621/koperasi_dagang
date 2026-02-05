<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChartOfAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'chart_of_accounts';

    protected $fillable = [
        'account_code',
        'account_name',
        'account_type',
        'account_category',
        'parent_id',
        'level',
        'normal_balance',
        'opening_balance',
        'current_balance',
        'is_cash_account',
        'is_bank_account',
        'is_header',
        'is_active',
        'description',
    ];

    protected $casts = [
        'level' => 'integer',
        'opening_balance' => 'decimal:2',
        'current_balance' => 'decimal:2',
        'is_cash_account' => 'boolean',
        'is_bank_account' => 'boolean',
        'is_header' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function parent()
    {
        return $this->belongsTo(ChartOfAccount::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ChartOfAccount::class, 'parent_id');
    }

    public function journalEntryDetails()
    {
        return $this->hasMany(JournalEntryDetail::class, 'account_id');
    }

    public function accountBalances()
    {
        return $this->hasMany(AccountBalance::class, 'account_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeHeaders($query)
    {
        return $query->where('is_header', true);
    }

    public function scopeDetails($query)
    {
        return $query->where('is_header', false);
    }

    // Helper Methods
    public function canHaveTransactions(): bool
    {
        return !$this->is_header;
    }
}
