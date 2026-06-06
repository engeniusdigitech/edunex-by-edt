<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelBill extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id', 'student_id', 'amount', 'paid_amount', 'due_amount',
        'billing_month', 'status', 'description'
    ];

    protected $casts = [
        'billing_month' => 'date',
        'amount'        => 'decimal:2',
        'paid_amount'   => 'decimal:2',
        'due_amount'    => 'decimal:2',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
