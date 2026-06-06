<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingLedger extends Model
{
    use HasFactory, BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'name',
        'type', // asset, liability, equity, revenue, expense
        'code',
        'is_system',
    ];

    protected $casts = [
        'is_system' => 'boolean',
    ];

    public function journalEntries()
    {
        return $this->hasMany(AccountingJournalEntry::class);
    }
}
