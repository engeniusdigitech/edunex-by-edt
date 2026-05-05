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
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batches = Batch::where('class_teacher_id', $user->id)->where('is_active', true)->get();
        } else {
            $batches = Batch::all();
        }
        
        $batchId = $request->get('batch_id');
        $month = $request->get('month', date('Y-m'));

        $reportData = [];
        if ($batchId) {
            $students = Student::where('batch_id', $batchId)->where('is_active', true)->with(['attendances' => function ($query) use ($month) {
                $query->where('date', 'like', $month . '%');
            }])->get();

            foreach ($students as $student) {
                $totalDays = $student->attendances->count();
                $presentDays = $student->attendances->whereIn('status', ['present', 'late'])->count();
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

    public function studentReport(\App\Models\Student $student)
    {
        $student->load('batch', 'institute');

        // All attendance records ordered by date
        $attendances = $student->attendances()->orderBy('date', 'asc')->get();

        $totalClasses = $attendances->count();
        $presentCount = $attendances->whereIn('status', ['present', 'late'])->count();
        $lateCount = $attendances->where('status', 'late')->count();
        $absentCount = $attendances->where('status', 'absent')->count();
        $percentage = $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100) : 0;

        // Group attendance by month for a calendar-style breakdown
        $attendanceByMonth = $attendances->groupBy(fn($a) => $a->date->format('Y-m'));

        // All payments
        $payments = $student->payments()->with('feeStructure')->orderBy('payment_date', 'desc')->get();
        $totalPaid = $payments->sum('amount_paid');

        // All test scores (for tests in student's batch)
        $tests = \App\Models\Test::where('batch_id', $student->batch_id)
            ->with(['scores' => function ($q) use ($student) {
            $q->where('student_id', $student->id);
        }])
            ->orderBy('test_date', 'desc')
            ->get();

        return view('reports.student', compact(
            'student', 'attendances', 'attendanceByMonth',
            'totalClasses', 'presentCount', 'lateCount', 'absentCount', 'percentage',
            'payments', 'totalPaid', 'tests'
        ));
    }

    public function exportStudentReportPdf(\App\Models\Student $student)
    {
        $student->load('batch', 'institute');

        $attendances = $student->attendances()->orderBy('date', 'asc')->get();

        $totalClasses = $attendances->count();
        $presentCount = $attendances->whereIn('status', ['present', 'late'])->count();
        $lateCount = $attendances->where('status', 'late')->count();
        $absentCount = $attendances->where('status', 'absent')->count();
        $percentage = $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100) : 0;

        $attendanceByMonth = $attendances->groupBy(fn($a) => $a->date->format('Y-m'));

        $payments = $student->payments()->with('feeStructure')->orderBy('payment_date', 'desc')->get();
        $totalPaid = $payments->sum('amount_paid');

        $tests = \App\Models\Test::where('batch_id', $student->batch_id)
            ->with(['scores' => fn($q) => $q->where('student_id', $student->id)])
            ->orderBy('test_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('reports.pdf.student', compact(
            'student', 'attendances', 'attendanceByMonth',
            'totalClasses', 'presentCount', 'lateCount', 'absentCount', 'percentage',
            'payments', 'totalPaid', 'tests'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('Student_Report_' . str_replace(' ', '_', $student->name) . '.pdf');
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
            $presentDays = $student->attendances->whereIn('status', ['present', 'late'])->count();
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
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batches = Batch::where('class_teacher_id', $user->id)->where('is_active', true)->get();
        } else {
            $batches = Batch::all();
        }

        $batchId = $request->get('batch_id');
        $month = $request->get('month', date('Y-m'));
        $search = $request->get('search');

        $query = Student::where('is_active', true)
            ->whereDoesntHave('payments', function ($q) use ($month) {
                $q->where('payment_date', 'like', $month . '%');
            });

        if ($batchId) {
            $query->where('batch_id', $batchId);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $defaulters = $query->with(['batch', 'institute'])->get();
        $currentMonth = $month;

        return view('reports.defaulters', compact('defaulters', 'currentMonth', 'batches', 'batchId', 'search'));
    }

    public function exportDefaultersPdf(Request $request)
    {
        $batchId = $request->get('batch_id');
        $month = $request->get('month', date('Y-m'));
        $search = $request->get('search');

        $query = Student::where('is_active', true)
            ->whereDoesntHave('payments', function ($q) use ($month) {
                $q->where('payment_date', 'like', $month . '%');
            });

        if ($batchId) {
            $query->where('batch_id', $batchId);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $defaulters = $query->with(['batch', 'institute'])->get();
        $currentMonth = $month;

        $pdf = Pdf::loadView('reports.pdf.defaulters', compact('defaulters', 'currentMonth'));
        return $pdf->download('Fee_Defaulters_Report_' . $currentMonth . '.pdf');
    }

    public function exportErpGuidePdf()
    {
        $pdf = Pdf::loadView('reports.pdf.erp_guide')->setPaper('a4', 'portrait');
        return $pdf->download('EduNex_ERP_Brief_Guide.pdf');
    }
}
