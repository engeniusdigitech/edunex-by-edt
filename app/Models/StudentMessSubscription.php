<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMessSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'hostel_mess_id', 'start_date', 'status'];

    protected $casts = [
        'start_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function mess()
    {
        return $this->belongsTo(HostelMess::class, 'hostel_mess_id');
    }
}
