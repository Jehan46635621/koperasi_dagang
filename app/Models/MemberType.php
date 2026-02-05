<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MemberType extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'code',
        'name',
        'description',
        'simpanan_pokok_amount',
        'simpanan_wajib_amount',
        'is_active',
    ];

    protected $casts = [
        'simpanan_pokok_amount' => 'decimal:2',
        'simpanan_wajib_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['code', 'name', 'simpanan_pokok_amount', 'simpanan_wajib_amount', 'is_active'])
            ->logOnlyDirty();
    }

    // Relationships
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
