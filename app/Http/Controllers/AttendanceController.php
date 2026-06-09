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

        $user = auth()->user();
        $batchesQuery = Batch::where('is_active', true);

        if ($user->isTeacher()) {
            $batchesQuery->where('class_teacher_id', $user->id);
        }

        $batches = $batchesQuery->get();

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
        
        // Load student models to get their phones and names for WhatsApp alerts
        $students = Student::whereIn('id', array_keys($validated['attendance']))->with('institute')->get()->keyBy('id');

        foreach ($validated['attendance'] as $studentId => $status) {
            Attendance::updateOrCreate(
                ['student_id' => $studentId, 'date' => $date],
                ['status' => $status]
            );

            // Send WhatsApp alert automatically if student is absent
            if ($status === 'absent' && isset($students[$studentId])) {
                $student = $students[$studentId];
                if ($student->phone) {
                    $instituteName = $student->institute->name ?? 'EduNex';
                    $formattedDate = date('d M Y', strtotime($date));
                    $message = "Dear Parent/Student,\n\nThis is to notify you that *{$student->name}* was marked ABSENT today ({$formattedDate}) at *{$instituteName}*.\n\nIf this was an error, please contact the administration office.\n\nThank you!";

                    \App\Services\WhatsAppService::sendWhatsApp($student->name, $student->phone, $message, 'attendance_alert');
                }
            }
        }

        return redirect()->route('attendance.index', [
            'batch_id' => $validated['batch_id'],
            'date' => $date
        ])->with('success', 'Attendance recorded successfully and absent WhatsApp notifications triggered!');
    }
}
