<?php

namespace App\Services\Library;

use App\Models\Library\AuditLog;

class AuditService
{
    /**
     * Log an audit trail entry for a library action.
     */
    public static function log(string $action, $model, ?array $oldValues = null, ?array $newValues = null): void
    {
        AuditLog::create([
            'user_id'    => auth()->id(),
            'action'     => $action,
            'model_type' => get_class($model),
            'model_id'   => $model->id,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
