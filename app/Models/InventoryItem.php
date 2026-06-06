<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = ['inventory_category_id', 'name', 'sku', 'unit', 'available_qty', 'min_qty_warning', 'unit_price'];

    protected $casts = [
        'unit_price' => 'decimal:2',
    ];

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'inventory_category_id');
    }

    public function stockLogs()
    {
        return $this->hasMany(InventoryStockLog::class);
    }
}
