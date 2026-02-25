<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use \App\Traits\BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'batch_id',
        'title',
        'description',
        'test_date',
        'total_marks',
    ];

    protected $casts = [
        'test_date' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function scores()
    {
        return $this->hasMany(TestScore::class);
    }
}
