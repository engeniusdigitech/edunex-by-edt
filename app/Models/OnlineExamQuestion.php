<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineExamQuestion extends Model
{
    protected $fillable = [
        'online_exam_id', 'question_bank_id', 'question',
        'option_a', 'option_b', 'option_c', 'option_d',
        'correct_option', 'marks', 'order',
    ];

    public function exam()
    {
        return $this->belongsTo(OnlineExam::class, 'online_exam_id');
    }

    public function bankQuestion()
    {
        return $this->belongsTo(QuestionBank::class, 'question_bank_id');
    }

    public function answers()
    {
        return $this->hasMany(OnlineExamAnswer::class);
    }
}
