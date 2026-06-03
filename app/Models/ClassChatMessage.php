<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassChatMessage extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'batch_id',
        'sender_type',
        'sender_id',
        'message',
    ];

    /**
     * Get the owning sender model (either User or Student).
     */
    public function sender()
    {
        return $this->morphTo();
    }

    /**
     * Get the batch (class) associated with the chat message.
     */
    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
