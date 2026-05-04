<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    protected $fillable = ['institute_id', 'user_id', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
