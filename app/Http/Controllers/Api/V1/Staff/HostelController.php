<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    public function overview(Request $request)
    {
        $stats = [];
        if (class_exists(\App\Models\HostelRoom::class)) {
            $stats['total_rooms'] = \App\Models\HostelRoom::count();
            $stats['occupied'] = \App\Models\HostelRoom::where('is_occupied', true)->count();
            $stats['available'] = $stats['total_rooms'] - $stats['occupied'];
        }
        return response()->json(['stats' => $stats, 'hostels' => []]);
    }

    public function leaves(Request $request)
    {
        $leaves = collect();
        if (class_exists(\App\Models\HostelLeave::class)) {
            $leaves = \App\Models\HostelLeave::with('student')
                ->where('status', $request->query('status', 'pending'))
                ->latest()
                ->get()
                ->map(fn($l) => [
                    'id' => $l->id,
                    'student_name' => $l->student?->name ?? '',
                    'from_date' => optional($l->from_date)->format('Y-m-d'),
                    'to_date' => optional($l->to_date)->format('Y-m-d'),
                    'reason' => $l->reason ?? null,
                    'status' => $l->status,
                ])->values();
        }
        return response()->json(['leaves' => $leaves]);
    }
}
