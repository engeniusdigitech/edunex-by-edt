<?php

namespace App\Traits;

use App\Models\Scopes\TenantScope;

trait BelongsToInstitute
{
    protected static function bootBelongsToInstitute()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (session()->has('institute_id') && !$model->institute_id) {
                $model->institute_id = session('institute_id');
            }
        });
    }

    public function institute()
    {
        return $this->belongsTo(\App\Models\Institute::class);
    }
}
