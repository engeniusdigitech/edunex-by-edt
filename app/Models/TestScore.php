<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestScore extends Model
{
    use \App\Traits\BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'test_id',
        'student_id',
        'score',
        'remarks',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
