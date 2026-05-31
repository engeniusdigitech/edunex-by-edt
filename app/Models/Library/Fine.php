<?php

namespace App\Models\Library;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fine extends Model
{
    use HasFactory, SoftDeletes, BelongsToInstitute;

    protected $table = 'library_fines';

    protected $fillable = [
        'book_issue_id',
        'fine_amount',
        'fine_reason',
        'payment_status',
        'payment_date',
        'remarks',
    ];

    protected $casts = [
        'fine_amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    /* ------------------------------------------------------------------ */
    /*  Relationships                                                      */
    /* ------------------------------------------------------------------ */

    public function bookIssue()
    {
        return $this->belongsTo(BookIssue::class);
    }

    /* ------------------------------------------------------------------ */
    /*  Scopes                                                             */
    /* ------------------------------------------------------------------ */

    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }
}
