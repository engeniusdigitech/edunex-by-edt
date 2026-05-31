<?php

namespace App\Models\Library;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes, BelongsToInstitute;

    protected $table = 'library_reservations';

    protected $fillable = [
        'book_id',
        'member_id',
        'member_type',
        'reservation_date',
        'expiry_date',
        'status',
    ];

    protected $casts = [
        'reservation_date' => 'date',
        'expiry_date' => 'date',
    ];

    /* ------------------------------------------------------------------ */
    /*  Relationships                                                      */
    /* ------------------------------------------------------------------ */

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->morphTo('member');
    }

    /* ------------------------------------------------------------------ */
    /*  Scopes                                                             */
    /* ------------------------------------------------------------------ */

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'pending')
                     ->where('expiry_date', '<', now()->startOfDay());
    }
}
