<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use \App\Traits\BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'batch_id',
        'name',
        'is_active',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
