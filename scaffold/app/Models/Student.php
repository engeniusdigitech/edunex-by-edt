<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'batch_id',
        'name',
        'email',
        'phone',
        'profile_image',
        'enrollment_date',
        'is_active',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
