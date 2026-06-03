<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BelongsToInstitute;

    protected $fillable = [
        'name',
        'email',
        'password',
        'institute_id',
        'role_id',
        'profile_image',
        'face_image',
        'face_descriptor',
        'face_enrolled_at',
        'responsibilities',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'face_descriptor' => 'array',
        'face_enrolled_at' => 'datetime',
    ];

    public function institute()
    {
        return $this->belongsTo(Institute::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isSuperAdmin()
    {
        return $this->role->name === 'Super Admin';
    }

    public function isInstituteAdmin()
    {
        return $this->role->name === 'Institute Admin';
    }

    public function isStaff()
    {
        return in_array($this->role->name ?? '', ['Staff', 'Teacher', 'Receptionist', 'Principal', 'Librarian']);
    }

    public function isTeacher()
    {
        return ($this->role->name ?? '') === 'Teacher';
    }

    public function isReceptionist()
    {
        return ($this->role->name ?? '') === 'Receptionist';
    }

    public function isPrincipal()
    {
        return ($this->role->name ?? '') === 'Principal';
    }

    public function isLibrarian()
    {
        return ($this->role->name ?? '') === 'Librarian';
    }

    public function isClassTeacher()
    {
        return $this->managedBatches()->exists();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class);
    }

    public function managedBatches()
    {
        return $this->hasMany(Batch::class, 'class_teacher_id');
    }

    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getFaceImageUrlAttribute()
    {
        if ($this->face_image) {
            return asset('storage/' . $this->face_image);
        }

        return null;
    }

    public function hasFaceEnrolled(): bool
    {
        return !empty($this->face_descriptor);
    }

    public function canUseBiometricAttendance(): bool
    {
        return $this->isTeacher() || $this->isReceptionist() || $this->isPrincipal() || $this->isLibrarian();
    }

    public function staffAttendances()
    {
        return $this->hasMany(StaffAttendance::class);
    }

    public function activeStaffSalary()
    {
        return $this->hasOne(StaffSalary::class)->where('is_active', true);
    }

    public function staffSalaries()
    {
        return $this->hasMany(StaffSalary::class);
    }

    public function staffPayrolls()
    {
        return $this->hasMany(StaffPayroll::class);
    }
}
