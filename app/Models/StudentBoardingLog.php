<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentBoardingLog extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'vehicle_trip_id',
        'student_id',
        'transport_stop_id',
        'direction', // pickup, dropoff
        'status', // boarded, deboarded, absent
        'logged_at',
    ];

    protected $casts = [
        'logged_at' => 'datetime',
    ];

    public function trip()
    {
        return $this->belongsTo(VehicleTrip::class, 'vehicle_trip_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function stop()
    {
        return $this->belongsTo(TransportStop::class, 'transport_stop_id');
    }
}
