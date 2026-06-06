<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
{
    use HasFactory;

    protected $fillable = ['hostel_id', 'room_number', 'room_type', 'capacity', 'cost_per_month'];

    protected $casts = [
        'cost_per_month' => 'decimal:2',
    ];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function allocations()
    {
        return $this->hasMany(HostelAllocation::class);
    }

    public function getAvailableBedsAttribute(): int
    {
        $occupied = $this->allocations()->where('status', 'active')->count();
        return max(0, $this->capacity - $occupied);
    }
}
