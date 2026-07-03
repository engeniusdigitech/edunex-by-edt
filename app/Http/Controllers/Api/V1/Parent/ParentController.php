<?php

namespace App\Http\Controllers\Api\V1\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    private function getStudents(Request $request)
    {
        $parent = $request->user();
        // Adjust relationship name to match your schema
        if (method_exists($parent, 'children')) {
            return $parent->children()->with('batch')->get();
        }
        if (method_exists($parent, 'students')) {
            return $parent->students()->with('batch')->get();
        }
        // Fallback: query Student model directly
        if (class_exists(\App\Models\Student::class)) {
            return \App\Models\Student::with('batch')
                ->where('parent_id', $parent->id)
                ->orWhere('guardian_id', $parent->id)
                ->get();
        }
        return collect();
    }

    public function children(Request $request)
    {
        $students = $this->getStudents($request);

        return response()->json([
            'children' => $students->map(fn($s) => [
                'id' => $s->id,
                'name' => $s->name,
                'profile_image_url' => $s->profile_photo_url ?? null,
                'roll_number' => $s->roll_number ?? null,
                'admission_no' => $s->admission_no ?? null,
                'batch' => $s->batch ? ['name' => $s->batch->name] : null,
            ])->values(),
        ]);
    }

    public function childProfile(Request $request, $studentId)
    {
        $student = \App\Models\Student::with(['batch', 'parent'])->findOrFail($studentId);

        return response()->json([
            'student' => [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'roll_number' => $student->roll_number ?? null,
                'admission_no' => $student->admission_no ?? null,
                'profile_image_url' => $student->profile_photo_url ?? null,
                'batch' => $student->batch ? ['name' => $student->batch->name] : null,
                'dob' => optional($student->dob)->format('Y-m-d'),
            ],
        ]);
    }

    public function childAttendance(Request $request, $studentId)
    {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        if (class_exists(\App\Models\Attendance::class)) {
            $attendances = \App\Models\Attendance::where('student_id', $studentId)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->orderBy('date', 'desc')
                ->get();

            $present = $attendances->where('status', 'present')->count();
            $absent = $attendances->where('status', 'absent')->count();
            $total = $attendances->count();

            return response()->json([
                'summary' => [
                    'present' => $present,
                    'absent' => $absent,
                    'total' => $total,
                    'percentage' => $total > 0 ? round(($present / $total) * 100, 1) : 0,
                ],
                'records' => $attendances->map(fn($a) => [
                    'date' => $a->date->format('Y-m-d'),
                    'status' => $a->status,
                ])->values(),
            ]);
        }

        return response()->json(['summary' => [], 'records' => []]);
    }

    public function childFees(Request $request, $studentId)
    {
        if (class_exists(\App\Models\Fee::class)) {
            $fees = \App\Models\Fee::with('installments')
                ->where('student_id', $studentId)
                ->get();

            return response()->json(['fees' => $fees]);
        }
        return response()->json(['fees' => []]);
    }

    public function childHomework(Request $request, $studentId)
    {
        if (class_exists(\App\Models\Homework::class)) {
            $student = \App\Models\Student::findOrFail($studentId);
            $homework = \App\Models\Homework::with('subject')
                ->where('batch_id', $student->batch_id)
                ->latest()
                ->get()
                ->map(fn($h) => [
                    'id' => $h->id,
                    'title' => $h->title,
                    'subject' => $h->subject?->name ?? '',
                    'due_date' => optional($h->due_date)->format('Y-m-d'),
                    'status' => $h->status ?? 'pending',
                    'description' => $h->description ?? null,
                ])->values();

            return response()->json(['homework' => $homework]);
        }
        return response()->json(['homework' => []]);
    }
}
