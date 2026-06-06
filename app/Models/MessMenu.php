<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessMenu extends Model
{
    use HasFactory;

    protected $fillable = ['hostel_mess_id', 'day_of_week', 'meal_type', 'menu_items'];

    public function mess()
    {
        return $this->belongsTo(HostelMess::class, 'hostel_mess_id');
    }
}
