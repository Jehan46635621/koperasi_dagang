<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'journal_number',
        'fiscal_period_id',
        'branch_id',
        'entry_date',
        'posting_date',
        'entry_type',
        'total_debit',
        'total_credit',
        'description',
        'notes',
        'source_type',
        'source_id',
        'status',
        'is_auto_generated',
        'created_by',
        'posted_by',
        'approved_by',
        'reversed_entry_id',
        'reversed_date',
    ];

    protected $casts = [
        'entry_date' => 'date',
        'posting_date' => 'date',
        'total_debit' => 'decimal:2',
        'total_credit' => 'decimal:2',
        'is_auto_generated' => 'boolean',
        'reversed_date' => 'date',
    ];

    // Relationships
    public function fiscalPeriod()
    {
        return $this->belongsTo(FiscalPeriod::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function details()
    {
        return $this->hasMany(JournalEntryDetail::class);
    }

    public function source()
    {
        return $this->morphTo();
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function poster()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function reversedEntry()
    {
        return $this->belongsTo(JournalEntry::class, 'reversed_entry_id');
    }

    // Scopes
    public function scopePosted($query)
    {
        return $query->where('status', 'posted');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Helper Methods
    public function isBalanced(): bool
    {
        return bccomp($this->total_debit, $this->total_credit, 2) === 0;
    }

    public function canBePosted(): bool
    {
        return $this->status === 'draft' && $this->isBalanced();
    }

    public function canBeReversed(): bool
    {
        return $this->status === 'posted' && !$this->reversed_entry_id;
    }
}
