<?php

namespace App\Models;

use App\Traits\BelongsToInstitute;
use Illuminate\Database\Eloquent\Model;

class StaffPayroll extends Model
{
    use BelongsToInstitute;

    protected $fillable = [
        'institute_id',
        'user_id',
        'month',
        'year',
        'basic_salary',
        'hra',
        'allowances',
        'deductions',
        'gross_salary',
        'net_salary',
        'present_days',
        'working_days',
        'status',
        'paid_at',
        'notes',
        'generated_by',
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'hra' => 'decimal:2',
        'allowances' => 'decimal:2',
        'deductions' => 'decimal:2',
        'gross_salary' => 'decimal:2',
        'net_salary' => 'decimal:2',
        'paid_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generatedBy()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function getPeriodLabelAttribute(): string
    {
        return \Carbon\Carbon::create($this->year, $this->month, 1)->format('F Y');
    }
}
