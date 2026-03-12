<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Assuming HasFactory is needed for use HasFactory;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'institute_id',
        'razorpay_key',
        'razorpay_secret',
        'stripe_public_key',
        'stripe_secret_key',
        'stripe_webhook_secret',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }
}
