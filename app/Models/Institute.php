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
        'feature_hr',
        'feature_visitor',
        'feature_fees',
        'feature_accounting',
        'feature_inventory',
        'feature_hostel',
        'feature_library',
        'feature_transport',
        'feature_whatsapp',
        'feature_live_classes',
        'feature_attendance',
        'feature_academics',
        'feature_lms',
        'feature_exams',
        'feature_curriculum',
        'feature_reports',
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'attendance_radius_meters' => 'integer',
        'feature_hr' => 'boolean',
        'feature_visitor' => 'boolean',
        'feature_fees' => 'boolean',
        'feature_accounting' => 'boolean',
        'feature_inventory' => 'boolean',
        'feature_hostel' => 'boolean',
        'feature_library' => 'boolean',
        'feature_transport' => 'boolean',
        'feature_whatsapp' => 'boolean',
        'feature_live_classes' => 'boolean',
        'feature_attendance' => 'boolean',
        'feature_academics' => 'boolean',
        'feature_lms' => 'boolean',
        'feature_exams' => 'boolean',
        'feature_curriculum' => 'boolean',
        'feature_reports' => 'boolean',
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
