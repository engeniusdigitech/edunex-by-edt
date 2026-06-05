<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineExamSession extends Model
{
    protected $fillable = [
        'online_exam_id', 'student_id',
        'started_at', 'submitted_at',
        'score', 'total_marks', 'percentage', 'is_passed',
        'tab_switch_count', 'status',
    ];

    protected $casts = [
        'started_at'   => 'datetime',
        'submitted_at' => 'datetime',
        'is_passed'    => 'boolean',
    ];

    public function exam()
    {
        return $this->belongsTo(OnlineExam::class, 'online_exam_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function answers()
    {
        return $this->hasMany(OnlineExamAnswer::class);
    }

    public function getRemainingSecondsAttribute(): int
    {
        if ($this->status !== 'in_progress') return 0;
        $exam        = $this->exam;
        $endByTimer  = $this->started_at->addMinutes($exam->duration_minutes);
        $endByWindow = $exam->end_datetime;
        $effectiveEnd = $endByTimer->lt($endByWindow) ? $endByTimer : $endByWindow;
        return max(0, (int) now()->diffInSeconds($effectiveEnd, false));
    }
}
