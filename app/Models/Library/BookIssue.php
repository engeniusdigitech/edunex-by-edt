<?php

namespace App\Models\Library;

use App\Models\User;
use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookIssue extends Model
{
    use HasFactory, SoftDeletes, BelongsToInstitute;

    protected $table = 'library_book_issues';

    protected $fillable = [
        'book_id',
        'member_id',
        'member_type',
        'issue_date',
        'due_date',
        'return_date',
        'status',
        'remarks',
        'issued_by',
        'returned_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
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

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }

    public function issuedByUser()
    {
        return $this->belongsTo(User::class, 'issued_by');
    }

    public function returnedByUser()
    {
        return $this->belongsTo(User::class, 'returned_by');
    }

    /* ------------------------------------------------------------------ */
    /*  Accessors                                                          */
    /* ------------------------------------------------------------------ */

    public function getIsOverdueAttribute(): bool
    {
        return $this->status === 'issued' && $this->due_date < now()->startOfDay();
    }

    public function getDaysOverdueAttribute(): int
    {
        if (!$this->is_overdue) {
            return 0;
        }

        return max(0, (int) now()->startOfDay()->diffInDays($this->due_date));
    }

    public function getCalculatedFineAttribute(): float
    {
        $settings = Setting::forInstitute();

        $finePerDay = $settings ? (float) $settings->fine_per_day : 0;

        return $this->days_overdue * $finePerDay;
    }

    /* ------------------------------------------------------------------ */
    /*  Scopes                                                             */
    /* ------------------------------------------------------------------ */

    public function scopeActive($query)
    {
        return $query->where('status', 'issued');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'issued')
                     ->where('due_date', '<', now()->startOfDay());
    }
}
