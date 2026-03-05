<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LiveLecture extends Model
{
    use \App\Traits\BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'batch_id',
        'subject',
        'title',
        'description',
        'video_path',
        'recorded_at',
    ];

    protected $casts = [
        'recorded_at' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
