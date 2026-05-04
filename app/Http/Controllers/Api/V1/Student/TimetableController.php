<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\TimetableSlot;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        $slots = TimetableSlot::where('batch_id', $student->batch_id)
            ->with(['subject', 'teacher'])
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        // Group by day name
        $timetable = [];
        
        $days = [
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
            7 => 'Sunday',
        ];

        foreach ($days as $dayNum => $dayName) {
            $daySlots = $slots->where('day', $dayNum)->values();
            $timetable[$dayName] = $daySlots->map(function ($slot) {
                return [
                    'id' => $slot->id,
                    'subject' => $slot->subject ? $slot->subject->name : null,
                    'teacher' => $slot->teacher ? $slot->teacher->name : null,
                    'start_time' => $slot->start_time,
                    'end_time' => $slot->end_time,
                    'room' => $slot->room_number,
                ];
            });
        }

        return response()->json([
            'timetable' => $timetable
        ]);
    }
}
