<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToInstitute;
use Carbon\Carbon;

class OnlineExam extends Model
{
    use BelongsToInstitute;

    protected $fillable = [
        'institute_id', 'batch_id', 'subject_id', 'created_by',
        'title', 'description', 'instructions',
        'start_datetime', 'end_datetime', 'duration_minutes',
        'total_marks', 'pass_percentage',
        'shuffle_questions', 'show_result_immediately', 'allow_review',
        'status',
    ];

    protected $casts = [
        'start_datetime'          => 'datetime',
        'end_datetime'            => 'datetime',
        'shuffle_questions'       => 'boolean',
        'show_result_immediately' => 'boolean',
        'allow_review'            => 'boolean',
    ];

    public function batch()    { return $this->belongsTo(Batch::class); }
    public function subject()  { return $this->belongsTo(Subject::class); }
    public function creator()  { return $this->belongsTo(User::class, 'created_by'); }
    public function questions(){ return $this->hasMany(OnlineExamQuestion::class)->orderBy('order'); }
    public function sessions() { return $this->hasMany(OnlineExamSession::class); }

    public function getStatusLabelAttribute(): string
    {
        $now = Carbon::now();
        if ($this->status === 'closed')    return 'Closed';
        if ($this->status === 'draft')     return 'Draft';
        if ($now->between($this->start_datetime, $this->end_datetime)) return 'Live';
        if ($now->lt($this->start_datetime)) return 'Upcoming';
        return 'Ended';
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status_label) {
            'Live'     => '#059669',
            'Upcoming' => '#2563EB',
            'Draft'    => '#64748B',
            'Ended'    => '#D97706',
            'Closed'   => '#DC2626',
            default    => '#64748B',
        };
    }

    public function isLive(): bool
    {
        return $this->status === 'published'
            && Carbon::now()->between($this->start_datetime, $this->end_datetime);
    }

    public function recalculateTotalMarks(): void
    {
        $this->update(['total_marks' => $this->questions()->sum('marks')]);
    }
}
