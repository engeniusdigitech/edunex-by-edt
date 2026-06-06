<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportStop extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'stop_name',
        'transport_route_id',
        'latitude',
        'longitude',
        'sort_order',
    ];

    public function route()
    {
        return $this->belongsTo(TransportRoute::class, 'transport_route_id');
    }

    public function allocations()
    {
        return $this->hasMany(StudentTransportAllocation::class);
    }
}
