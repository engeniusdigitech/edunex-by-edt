<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingJournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'accounting_voucher_id',
        'accounting_ledger_id',
        'entry_type', // debit, credit
        'amount',
    ];

    public function voucher()
    {
        return $this->belongsTo(AccountingVoucher::class, 'accounting_voucher_id');
    }

    public function ledger()
    {
        return $this->belongsTo(AccountingLedger::class, 'accounting_ledger_id');
    }
}
