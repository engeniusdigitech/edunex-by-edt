<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingVoucher extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'voucher_number',
        'type', // receipt, payment, journal
        'date',
        'narration',
        'amount',
        'reference_id',
        'reference_type',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function journalEntries()
    {
        return $this->hasMany(AccountingJournalEntry::class);
    }

    public function reference()
    {
        return $this->morphTo();
    }
}
