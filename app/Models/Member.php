<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Member extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'member_number',
        'member_type_id',
        'branch_id',
        'full_name',
        'nik',
        'gender',
        'birth_date',
        'birth_place',
        'phone',
        'email',
        'address',
        'city',
        'province',
        'postal_code',
        'employer_name',
        'employer_address',
        'occupation',
        'employee_id',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
        'join_date',
        'resign_date',
        'status',
        'resign_reason',
        'simpanan_pokok_paid',
        'simpanan_wajib_balance',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'join_date' => 'date',
        'resign_date' => 'date',
        'simpanan_pokok_paid' => 'decimal:2',
        'simpanan_wajib_balance' => 'decimal:2',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['member_number', 'full_name', 'status', 'email', 'phone'])
            ->logOnlyDirty();
    }

    // Relationships
    public function memberType()
    {
        return $this->belongsTo(MemberType::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function savingsAccounts()
    {
        return $this->hasMany(SavingsAccount::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
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

    public function scopeByBranch($query, $branchId)
    {
        return $query->where('branch_id', $branchId);
    }

    // Helper Methods
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function getTotalSavings(): float
    {
        return $this->savingsAccounts()->sum('balance');
    }

    public function getTotalLoanOutstanding(): float
    {
        return $this->loans()
            ->whereIn('status', ['disbursed', 'active'])
            ->sum('total_outstanding');
    }
}
