<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LiveLecture extends Model
{
    use \App\Traits\BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'batch_id',
        'subject',
        'title',
        'description',
        'video_path',
        'recorded_at',
        'room_name',
        'status',
    ];

    protected $casts = [
        'recorded_at' => 'date',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function isLive(): bool
    {
        return $this->status === 'live';
    }

    public function isEnded(): bool
    {
        return $this->status === 'ended';
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function getJitsiRoomUrl(): string
    {
        return 'https://meet.jit.si/' . $this->room_name;
    }

    /**
     * Generate a unique, URL-safe room name for Jitsi.
     */
    public static function generateRoomName(string $title): string
    {
        return 'edunex-' . Str::slug($title) . '-' . Str::random(8);
    }
}
