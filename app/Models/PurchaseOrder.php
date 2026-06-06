<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id', 'po_number', 'inventory_supplier_id', 'order_date',
        'delivery_date', 'total_amount', 'status', 'created_by'
    ];

    protected $casts = [
        'order_date'    => 'date',
        'delivery_date' => 'date',
        'total_amount'  => 'decimal:2',
    ];

    public function supplier()
    {
        return $this->belongsTo(InventorySupplier::class, 'inventory_supplier_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
