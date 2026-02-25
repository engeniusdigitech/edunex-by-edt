<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use \App\Traits\BelongsToInstitute;

    protected $table = 'homework';

    protected $fillable = [
        'institute_id',
        'batch_id',
        'title',
        'description',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
