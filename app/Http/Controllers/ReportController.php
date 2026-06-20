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

    public function sendBulkWhatsAppReminders(Request $request)
    {
        $month = $request->get('month', date('Y-m'));
        $batchId = $request->get('batch_id');
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

        if ($defaulters->isEmpty()) {
            return back()->with('error', 'No fee defaulters found to notify for this selection.');
        }

        $sentCount = 0;
        foreach ($defaulters as $student) {
            if (!$student->phone) {
                continue;
            }

            $instituteName = $student->institute->name ?? 'EduNex ERP';
            $message = "Dear {$student->name},\n\nThis is an automated reminder from *{$instituteName}* that your fee payment for the month of " . date('F Y', strtotime($month . '-01')) . " is currently pending.\n\nPlease clear your outstanding dues at your earliest convenience.\n\nThank you!";

            // Send via service
            if (\App\Services\WhatsAppService::sendWhatsApp($student->name, $student->phone, $message, 'fee_reminder')) {
                $sentCount++;
            }
        }

        $mode = \App\Services\WhatsAppService::getSettings()['mode'] ?? 'simulator';
        $statusText = $mode === 'simulator' ? 'simulated and logged' : 'sent';

        return back()->with('success', "WhatsApp fee reminders successfully {$statusText} for {$sentCount} defaulter(s).");
    }

    public function exportErpGuidePdf()
    {
        $pdf = Pdf::loadView('reports.pdf.erp_guide')->setPaper('a4', 'portrait');
        return $pdf->download('EduNex_ERP_Brief_Guide.pdf');
    }

    // ─────────────────────────────────────────────
    // LMS Report
    // ─────────────────────────────────────────────
    public function lmsReport(\Illuminate\Http\Request $request)
    {
        $user    = auth()->user();
        $batches = $user->isTeacher()
            ? Batch::where('class_teacher_id', $user->id)->where('is_active', true)->get()
            : Batch::where('institute_id', $user->institute_id)->get();

        $batchId   = $request->get('batch_id');
        $subjectId = $request->get('subject_id');
        $subjects  = $batchId ? \App\Models\Subject::where('batch_id', $batchId)->get() : collect();

        // Study Materials
        $materialsQuery = \App\Models\StudyMaterial::where('institute_id', $user->institute_id)
            ->with(['batch', 'subject', 'uploader']);
        if ($batchId)   $materialsQuery->where('batch_id', $batchId);
        if ($subjectId) $materialsQuery->where('subject_id', $subjectId);
        $materials = $materialsQuery->orderBy('created_at', 'desc')->get();

        // Homework
        $homeworkQuery = \App\Models\Homework::where('institute_id', $user->institute_id)
            ->with(['batch', 'subject', 'attachments']);
        if ($batchId)   $homeworkQuery->where('batch_id', $batchId);
        if ($subjectId) $homeworkQuery->where('subject_id', $subjectId);
        $homeworks = $homeworkQuery->orderBy('due_date', 'desc')->get();

        // Live Lectures
        $lecturesQuery = \App\Models\LiveLecture::where('institute_id', $user->institute_id)
            ->with(['batch']);
        if ($batchId)   $lecturesQuery->where('batch_id', $batchId);
        $lectures = $lecturesQuery->orderBy('recorded_at', 'desc')->get();

        // Aggregates
        $totalMaterials   = $materials->count();
        $totalDownloads   = $materials->sum('download_count');
        $totalHomework    = $homeworks->count();
        $overdueHomework  = $homeworks->where('due_date', '<', now())->count();
        $totalLectures    = $lectures->count();

        // Materials by subject breakdown
        $materialsBySubject = $materials->groupBy(fn($m) => optional($m->subject)->name ?? 'General');

        return view('reports.lms', compact(
            'batches', 'batchId', 'subjectId', 'subjects',
            'materials', 'homeworks', 'lectures',
            'totalMaterials', 'totalDownloads', 'totalHomework', 'overdueHomework', 'totalLectures',
            'materialsBySubject'
        ));
    }

    // ─────────────────────────────────────────────
    // Tests & Exams Report
    // ─────────────────────────────────────────────
    public function examsReport(\Illuminate\Http\Request $request)
    {
        $user    = auth()->user();
        $batches = $user->isTeacher()
            ? Batch::where('class_teacher_id', $user->id)->where('is_active', true)->get()
            : Batch::where('institute_id', $user->institute_id)->get();

        $batchId = $request->get('batch_id');
        $tab     = $request->get('tab', 'tests'); // 'tests' or 'online'

        // ── Written Tests ──
        $testsQuery = \App\Models\Test::where('institute_id', $user->institute_id)
            ->with(['batch', 'subject', 'scores.student']);
        if ($batchId) $testsQuery->where('batch_id', $batchId);
        $tests = $testsQuery->orderBy('test_date', 'desc')->get();

        // Annotate each test with computed stats
        $tests->each(function ($test) {
            $scores = $test->scores;
            $test->students_count = $scores->count();
            $test->avg_score      = $scores->count() > 0 ? round($scores->avg('score'), 1) : null;
            $test->highest        = $scores->count() > 0 ? $scores->max('score') : null;
            $test->lowest         = $scores->count() > 0 ? $scores->min('score') : null;
            $test->pass_count     = $test->total_marks > 0
                ? $scores->filter(fn($s) => ($s->score / $test->total_marks) * 100 >= 40)->count()
                : 0;
        });

        $totalTests    = $tests->count();
        $avgTestScore  = $tests->whereNotNull('avg_score')->avg('avg_score');

        // ── Online Exams ──
        $onlineQuery = \App\Models\OnlineExam::where('institute_id', $user->institute_id)
            ->with(['batch', 'subject', 'sessions.student']);
        if ($batchId) $onlineQuery->where('batch_id', $batchId);
        $onlineExams = $onlineQuery->orderBy('start_datetime', 'desc')->get();

        $onlineExams->each(function ($exam) {
            $submitted = $exam->sessions->where('status', 'submitted');
            $exam->attempts_count = $submitted->count();
            $exam->avg_score      = $submitted->count() > 0 ? round($submitted->avg('percentage'), 1) : null;
            $exam->pass_count     = $submitted->where('is_passed', true)->count();
            $exam->fail_count     = $submitted->where('is_passed', false)->count();
        });

        $totalOnlineExams = $onlineExams->count();

        return view('reports.exams', compact(
            'batches', 'batchId', 'tab',
            'tests', 'totalTests', 'avgTestScore',
            'onlineExams', 'totalOnlineExams'
        ));
    }
}
