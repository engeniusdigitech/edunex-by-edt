<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Model;

class StaffSalary extends Model
{
    use BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'user_id',
        'basic_salary',
        'hra',
        'allowances',
        'deductions',
        'effective_from',
        'is_active',
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'hra' => 'decimal:2',
        'allowances' => 'decimal:2',
        'deductions' => 'decimal:2',
        'effective_from' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGrossMonthlyAttribute(): float
    {
        return (float) $this->basic_salary + (float) $this->hra + (float) $this->allowances;
    }

    public function getNetMonthlyAttribute(): float
    {
        return $this->gross_monthly - (float) $this->deductions;
    }
}
