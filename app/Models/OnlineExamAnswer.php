<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineExamAnswer extends Model
{
    protected $fillable = [
        'online_exam_session_id', 'online_exam_question_id',
        'selected_option', 'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function session()
    {
        return $this->belongsTo(OnlineExamSession::class, 'online_exam_session_id');
    }

    public function question()
    {
        return $this->belongsTo(OnlineExamQuestion::class, 'online_exam_question_id');
    }
}
