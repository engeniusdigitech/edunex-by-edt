<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->input('date', date('Y-m-d'));
        $batchId = $request->input('batch_id');

        $batches = Batch::where('is_active', true)->get();

        $students = collect();
        if ($batchId) {
            $students = Student::where('batch_id', $batchId)
                ->where('is_active', true)
                ->with(['attendances' => function ($query) use ($date) {
                $query->whereDate('date', $date);
            }])
                ->get();
        }

        return view('attendance.index', compact('batches', 'students', 'date', 'batchId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'batch_id' => 'required|exists:batches,id',
            'attendance' => 'required|array',
            'attendance.*' => 'in:present,absent,late'
        ]);

        $date = $validated['date'];

        foreach ($validated['attendance'] as $studentId => $status) {
            Attendance::updateOrCreate(
            ['student_id' => $studentId, 'date' => $date],
            ['status' => $status]
            );
        }

        return redirect()->route('attendance.index', [
            'batch_id' => $validated['batch_id'],
            'date' => $date
        ])->with('success', 'Attendance recorded successfully!');
    }
}
