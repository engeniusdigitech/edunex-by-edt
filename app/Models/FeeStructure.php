<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'fee_category_id',
        'name',
        'total_amount',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(FeeCategory::class , 'fee_category_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function studentFees()
    {
        return $this->hasMany(StudentFee::class);
    }
}
