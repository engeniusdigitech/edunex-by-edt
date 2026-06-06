<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelMess extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = ['institute_id', 'name', 'warden_name', 'description'];

    public function menus()
    {
        return $this->hasMany(MessMenu::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(StudentMessSubscription::class);
    }
}
