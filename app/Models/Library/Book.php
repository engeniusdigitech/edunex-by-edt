<?php

namespace App\Models\Library;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes, BelongsToInstitute;

    protected $table = 'library_books';

    protected $fillable = [
        'category_id',
        'author_id',
        'publisher_id',
        'title',
        'isbn',
        'edition',
        'language',
        'rack_number',
        'description',
        'total_copies',
        'available_copies',
        'cover_image',
        'barcode',
        'qr_data',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'total_copies' => 'integer',
        'available_copies' => 'integer',
    ];

    /* ------------------------------------------------------------------ */
    /*  Relationships                                                      */
    /* ------------------------------------------------------------------ */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function bookIssues()
    {
        return $this->hasMany(BookIssue::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function digitalResources()
    {
        return $this->hasMany(DigitalResource::class);
    }

    /* ------------------------------------------------------------------ */
    /*  Accessors                                                          */
    /* ------------------------------------------------------------------ */

    public function getCoverImageUrlAttribute(): string
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }

        return asset('images/placeholder-book.png');
    }

    public function getIsAvailableAttribute(): bool
    {
        return $this->available_copies > 0;
    }

    /* ------------------------------------------------------------------ */
    /*  Scopes                                                             */
    /* ------------------------------------------------------------------ */

    public function scopeAvailable($query)
    {
        return $query->where('available_copies', '>', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('isbn', 'like', "%{$term}%")
              ->orWhereHas('author', function ($authorQuery) use ($term) {
                  $authorQuery->where('name', 'like', "%{$term}%");
              });
        });
    }
}
