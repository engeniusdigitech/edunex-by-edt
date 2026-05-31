<?php

namespace App\Models\Library;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $table = 'library_settings';

    protected $fillable = [
        'institute_id',
        'max_books_student',
        'max_books_staff',
        'max_borrow_days',
        'fine_per_day',
        'reservation_expiry_days',
        'library_working_days',
    ];

    protected $casts = [
        'fine_per_day' => 'decimal:2',
        'library_working_days' => 'array',
    ];

    /**
     * Get the library settings for the current institute.
     * TenantScope auto-filters by institute_id from session.
     */
    public static function forInstitute(): ?self
    {
        return static::first();
    }
}
