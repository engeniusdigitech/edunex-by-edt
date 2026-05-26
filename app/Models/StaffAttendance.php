<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    use BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'user_id',
        'date',
        'mark_in_at',
        'mark_out_at',
        'mark_in_latitude',
        'mark_in_longitude',
        'mark_out_latitude',
        'mark_out_longitude',
        'mark_in_distance_meters',
        'mark_out_distance_meters',
        'face_verified_in',
        'face_verified_out',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'mark_in_at' => 'datetime',
        'mark_out_at' => 'datetime',
        'face_verified_in' => 'boolean',
        'face_verified_out' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isMarkedIn(): bool
    {
        return $this->mark_in_at !== null;
    }

    public function isMarkedOut(): bool
    {
        return $this->mark_out_at !== null;
    }
}
