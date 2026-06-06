<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleTrip extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'vehicle_id',
        'transport_route_id',
        'status', // scheduled, en_route, completed
        'current_lat',
        'current_lng',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'current_lat' => 'float',
        'current_lng' => 'float',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function route()
    {
        return $this->belongsTo(TransportRoute::class, 'transport_route_id');
    }

    public function boardingLogs()
    {
        return $this->hasMany(StudentBoardingLog::class);
    }
}
