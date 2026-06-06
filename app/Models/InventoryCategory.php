<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = ['institute_id', 'name', 'description'];

    public function items()
    {
        return $this->hasMany(InventoryItem::class);
    }
}
