<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'accounting_ledger_id',
        'supplier_id',
        'expense_date',
        'net_amount',
        'gst_rate',
        'gst_type', // cgst_sgst, igst, none
        'gst_amount',
        'total_amount',
        'payment_method', // Cash, Bank, Card
        'reference_no',
        'description',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'net_amount' => 'float',
        'gst_rate' => 'float',
        'gst_amount' => 'float',
        'total_amount' => 'float',
    ];

    public function ledger()
    {
        return $this->belongsTo(AccountingLedger::class, 'accounting_ledger_id');
    }

    public function supplier()
    {
        return $this->belongsTo(InventorySupplier::class, 'supplier_id');
    }

    public function voucher()
    {
        return $this->morphOne(AccountingVoucher::class, 'reference');
    }
}
