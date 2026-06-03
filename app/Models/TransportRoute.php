<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRoute extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'route_name',
        'route_description',
        'fee',
    ];

    public function stops()
    {
        return $this->hasMany(TransportStop::class);
    }

    public function allocations()
    {
        return $this->hasMany(StudentTransportAllocation::class);
    }
}
