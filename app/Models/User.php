<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, BelongsToInstitute;

    protected $fillable = [
        'name',
        'email',
        'password',
        'institute_id',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
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
        return in_array($this->role->name ?? '', ['Staff', 'Teacher', 'Receptionist']);
    }

    public function isTeacher()
    {
        return ($this->role->name ?? '') === 'Teacher';
    }

    public function isReceptionist()
    {
        return ($this->role->name ?? '') === 'Receptionist';
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class);
    }
}
