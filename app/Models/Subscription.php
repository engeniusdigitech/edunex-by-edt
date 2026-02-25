<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'plan_id',
        'starts_at',
        'ends_at',
        'status',
        'razorpay_subscription_id',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function isValid()
    {
        return $this->status === 'active' && $this->ends_at->isFuture();
    }
}
