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
        'name',
        'total_amount',
        'description',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
