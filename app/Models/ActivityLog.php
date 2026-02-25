<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    // We don't strictly use BelongsToInstitute trait here because
    // SuperAdmin activity logs might not have an institute_id.

    protected $fillable = [
        'institute_id',
        'user_id',
        'action',
        'description',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
