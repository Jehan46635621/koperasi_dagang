<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCollateral extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'type',
        'description',
        'estimated_value',
        'document_number',
        'document_date',
        'details',
        'status',
        'return_date',
        'notes',
    ];

    protected $casts = [
        'estimated_value' => 'decimal:2',
        'document_date' => 'date',
        'return_date' => 'date',
    ];

    // Relationships
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
