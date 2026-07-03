<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffTimetableController extends Controller
{
    public function index(Request $request)
    {
        $staff = $request->user();
        $timetable = [];
        if (class_exists(\App\Models\Timetable::class)) {
            $timetable = \App\Models\Timetable::with(['subject', 'batch'])
                ->where('staff_id', $staff->id)
                ->get()
                ->groupBy('day')
                ->map(fn($periods) => $periods->map(fn($p) => [
                    'id' => $p->id,
                    'subject' => $p->subject?->name ?? '',
                    'batch' => $p->batch?->name ?? '',
                    'start_time' => $p->start_time,
                    'end_time' => $p->end_time,
                    'room' => $p->room ?? null,
                ])->values())->toArray();
        }
        return response()->json(['timetable' => $timetable]);
    }
}
