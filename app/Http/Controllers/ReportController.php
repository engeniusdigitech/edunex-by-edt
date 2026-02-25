<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function attendance(Request $request)
    {
        $batches = Batch::all();
        $batchId = $request->get('batch_id');
        $month = $request->get('month', date('Y-m'));

        $reportData = [];
        if ($batchId) {
            $students = Student::where('batch_id', $batchId)->where('is_active', true)->with(['attendances' => function ($query) use ($month) {
                $query->where('date', 'like', $month . '%');
            }])->get();

            foreach ($students as $student) {
                $totalDays = $student->attendances->count();
                $presentDays = $student->attendances->where('status', 'present')->count();
                $percentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 0;

                $reportData[] = [
                    'student' => $student,
                    'total' => $totalDays,
                    'present' => $presentDays,
                    'percentage' => $percentage,
                ];
            }
        }

        return view('reports.attendance', compact('batches', 'batchId', 'month', 'reportData'));
    }

    public function exportAttendancePdf(Request $request)
    {
        $batchId = $request->get('batch_id');
        $month = $request->get('month', date('Y-m'));
        $batch = Batch::findOrFail($batchId);

        $students = Student::where('batch_id', $batchId)->where('is_active', true)->with(['attendances' => function ($query) use ($month) {
            $query->where('date', 'like', $month . '%');
        }])->get();

        $reportData = [];
        foreach ($students as $student) {
            $totalDays = $student->attendances->count();
            $presentDays = $student->attendances->where('status', 'present')->count();
            $percentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 0;

            $reportData[] = [
                'student' => $student,
                'total' => $totalDays,
                'present' => $presentDays,
                'percentage' => $percentage,
            ];
        }

        $pdf = Pdf::loadView('reports.pdf.attendance', compact('batch', 'month', 'reportData'));
        return $pdf->download('Attendance_Report_' . $batch->name . '_' . $month . '.pdf');
    }

    public function defaulters(Request $request)
    {
        $students = Student::with(['payments', 'batch'])->where('is_active', true)->get();
        // Since we don't have a direct 'fee_assigned' to compare easily by default without logic, 
        // we'll assume a basic logic: Check if they haven't made a payment this month
        $defaulters = [];
        $currentMonth = date('Y-m');

        foreach ($students as $student) {
            $hasPaidThisMonth = $student->payments()->where('payment_date', 'like', $currentMonth . '%')->exists();
            if (!$hasPaidThisMonth) {
                $defaulters[] = $student;
            }
        }

        return view('reports.defaulters', compact('defaulters', 'currentMonth'));
    }

    public function exportDefaultersPdf(Request $request)
    {
        $students = Student::with(['payments', 'batch'])->where('is_active', true)->get();
        $defaulters = [];
        $currentMonth = date('Y-m');

        foreach ($students as $student) {
            $hasPaidThisMonth = $student->payments()->where('payment_date', 'like', $currentMonth . '%')->exists();
            if (!$hasPaidThisMonth) {
                $defaulters[] = $student;
            }
        }

        $pdf = Pdf::loadView('reports.pdf.defaulters', compact('defaulters', 'currentMonth'));
        return $pdf->download('Fee_Defaulters_Report_' . $currentMonth . '.pdf');
    }
}
