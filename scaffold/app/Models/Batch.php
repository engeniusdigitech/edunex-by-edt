<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'name',
        'schedule_time',
        'is_active',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
