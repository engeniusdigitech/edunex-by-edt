<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventorySupplier extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = ['institute_id', 'name', 'contact_person', 'phone', 'email', 'address'];

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }
}
