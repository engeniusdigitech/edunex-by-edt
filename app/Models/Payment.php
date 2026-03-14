<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'student_id',
        'fee_structure_id',
        'student_fee_id',
        'amount_paid',
        'payment_date',
        'payment_method',
        'razorpay_payment_id',
        'status',
        'gateway',
        'transaction_id',
        'currency',
        'payment_status',
        'receipt_number',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class);
    }

    public function studentFee()
    {
        return $this->belongsTo(StudentFee::class);
    }
}
