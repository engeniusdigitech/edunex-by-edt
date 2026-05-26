<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subdomain',
        'contact_email',
        'phone',
        'address',
        'latitude',
        'longitude',
        'attendance_radius_meters',
        'country',
        'logo',
        'type',
        'is_active',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'attendance_radius_meters' => 'integer',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function paymentGateway()
    {
        return $this->hasOne(PaymentGateway::class);
    }

    public function isSchool()
    {
        return $this->type === 'school';
    }
}
