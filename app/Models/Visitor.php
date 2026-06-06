<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'pass_number',
        'visitor_name',
        'phone_number',
        'email',
        'purpose',
        'whom_to_meet_id',
        'whom_to_meet_name',
        'gate_number',
        'vehicle_number',
        'id_proof_type',
        'id_proof_number',
        'check_in_time',
        'check_out_time',
        'status',
        'remarks',
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime',
    ];

    public function whomToMeet()
    {
        return $this->belongsTo(User::class, 'whom_to_meet_id');
    }
}
