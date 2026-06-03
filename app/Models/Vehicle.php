<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'vehicle_number',
        'vehicle_name',
        'capacity',
        'is_active',
    ];

    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }

    public function allocations()
    {
        return $this->hasMany(StudentTransportAllocation::class);
    }
}
