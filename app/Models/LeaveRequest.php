<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'user_id',
        'student_id',
        'type',
        'start_date',
        'end_date',
        'reason',
        'status',
        'reviewed_by',
        'rejection_reason',
        'status_updated_at',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'status_updated_at' => 'datetime',
    ];

    /**
     * Check if the leave request can be withdrawn by the applicant (within 6 hours of creation).
     */
    public function canBeWithdrawnByApplicant()
    {
        return $this->status === 'pending' && 
               $this->created_at->diffInHours(now()) < 6;
    }

    /**
     * Check if the leave decision can be reverted by a reviewer (within 24 hours of the decision).
     */
    public function canBeRevertedByReviewer()
    {
        return $this->status !== 'pending' && 
               $this->status_updated_at && 
               $this->status_updated_at->diffInHours(now()) < 24;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
