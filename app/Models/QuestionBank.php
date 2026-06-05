<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToInstitute;

class QuestionBank extends Model
{
    use BelongsToInstitute;

    protected $fillable = [
        'institute_id', 'subject_id', 'batch_id', 'question', 'type',
        'option_a', 'option_b', 'option_c', 'option_d',
        'correct_option', 'marks', 'difficulty', 'explanation',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function examQuestions()
    {
        return $this->hasMany(OnlineExamQuestion::class);
    }

    public function getDifficultyColorAttribute(): string
    {
        return match($this->difficulty) {
            'easy'   => '#059669',
            'medium' => '#D97706',
            'hard'   => '#DC2626',
            default  => '#64748B',
        };
    }
}
