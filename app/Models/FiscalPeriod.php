<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiscalPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'year',
        'month',
        'start_date',
        'end_date',
        'status',
        'closed_date',
        'closed_by',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'start_date' => 'date',
        'end_date' => 'date',
        'closed_date' => 'date',
    ];

    // Relationships
    public function journalEntries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    public function accountBalances()
    {
        return $this->hasMany(AccountBalance::class);
    }

    public function closer()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    // Helper Methods
    public function isOpen(): bool
    {
        return $this->status === 'open';
    }

    public function isClosed(): bool
    {
        return in_array($this->status, ['closed', 'locked']);
    }

    public function canPost(): bool
    {
        return $this->status === 'open';
    }
}
