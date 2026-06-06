<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = ['institute_id', 'name', 'type', 'address', 'description'];

    public function rooms()
    {
        return $this->hasMany(HostelRoom::class);
    }
}
