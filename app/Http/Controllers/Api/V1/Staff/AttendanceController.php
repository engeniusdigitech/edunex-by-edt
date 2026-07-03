<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function students(Request $request)
    {
        $batchId = $request->query('batch_id');
        $students = collect();
        if (class_exists(\App\Models\Student::class)) {
            $query = \App\Models\Student::query();
            if ($batchId) {
                $query->where('batch_id', $batchId);
            }
            $students = $query->get()->map(fn($s) => [
                'id' => $s->id,
                'name' => $s->name,
                'roll_number' => $s->roll_number ?? null,
                'profile_image_url' => $s->profile_photo_url ?? null,
            ])->values();
        }
        return response()->json(['students' => $students]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'batch_id' => 'required',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required',
            'attendance.*.status' => 'required|in:present,absent,late,half_day',
        ]);

        if (class_exists(\App\Models\Attendance::class)) {
            foreach ($request->attendance as $record) {
                \App\Models\Attendance::updateOrCreate(
                    ['student_id' => $record['student_id'], 'date' => $request->date],
                    ['status' => $record['status'], 'marked_by' => $request->user()->id]
                );
            }
        }

        return response()->json(['message' => 'Attendance submitted successfully']);
    }
}
