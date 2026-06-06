<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStockLog extends Model
{
    use HasFactory;

    protected $fillable = ['inventory_item_id', 'type', 'quantity', 'reference', 'logged_by'];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class, 'inventory_item_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'logged_by');
    }
}
