<?php

namespace App\Models\Library;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DigitalResource extends Model
{
    use HasFactory, SoftDeletes, BelongsToInstitute;

    protected $table = 'library_digital_resources';

    protected $fillable = [
        'book_id',
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'is_downloadable',
        'access_roles',
        'download_count',
        'status',
    ];

    protected $casts = [
        'is_downloadable' => 'boolean',
        'status' => 'boolean',
        'access_roles' => 'array',
        'download_count' => 'integer',
        'file_size' => 'integer',
    ];

    /* ------------------------------------------------------------------ */
    /*  Relationships                                                      */
    /* ------------------------------------------------------------------ */

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /* ------------------------------------------------------------------ */
    /*  Accessors                                                          */
    /* ------------------------------------------------------------------ */

    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;

        if (!$bytes || $bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $factor = floor(log($bytes, 1024));
        $factor = min($factor, count($units) - 1);

        return round($bytes / pow(1024, $factor), 2) . ' ' . $units[$factor];
    }
}
