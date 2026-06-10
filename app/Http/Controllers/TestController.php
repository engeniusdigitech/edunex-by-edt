<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Batch;
use App\Models\TestScore;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Test::with(['batch', 'subject', 'scores']);

        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id');
            $query->whereIn('batch_id', $batchIds);
            $batches = $user->batches()->where('is_active', true)->get();
        } else {
            $batches = Batch::where('is_active', true)->get();
        }

        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        $tests = $query->latest()->paginate(15);
        $subjects = Subject::where('is_active', true)->get();

        return view('tests.index', compact('tests', 'batches', 'subjects'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batches = $user->batches()->where('is_active', true)->get();
        } else {
            $batches = Batch::where('is_active', true)->get();
        }
        $subjects = Subject::where('is_active', true)->get();
        return view('tests.create', compact('batches', 'subjects'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($request->batch_id, $batchIds)) {
                return back()->withErrors(['batch_id' => 'You can only schedule tests for your own batches.']);
            }
        }

        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'test_date' => 'required|date',
            'total_marks' => 'required|integer|min:1',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        $test = Test::create($validated);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $test->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getMimeType(),
                ]);
            }
        }

        // Notify all students in this batch
        $students = \App\Models\Student::where('batch_id', $test->batch_id)->with('institute')->get();
        if ($students->count() > 0) {
            \Illuminate\Support\Facades\Notification::send($students, new \App\Notifications\NewTestNotification($test));

            // Notify all students via WhatsApp
            $subject = Subject::find($test->subject_id);
            $subjectName = $subject->name ?? 'Subject';
            $formattedDate = date('d M Y', strtotime($test->test_date));

            foreach ($students as $student) {
                if ($student->phone) {
                    $instituteName = $student->institute->name ?? 'EduNex ERP';
                    $message = "Dear Student,\n\nA new test *'{$test->title}'* for subject *{$subjectName}* has been scheduled on *{$formattedDate}*.\n\nTotal Marks: {$test->total_marks}\n\nPlease prepare accordingly.\n\nBest of luck!\n— *{$instituteName}*";

                    \App\Services\WhatsAppService::sendWhatsApp($student->name, $student->phone, $message, 'exam_notification');
                }
            }
        }

        return redirect()->route('tests.index')
            ->with('success', 'Test scheduled successfully, students notified, and WhatsApp alerts triggered.');
    }

    public function edit(Test $test)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($test->batch_id, $batchIds)) {
                abort(403, 'Unauthorized access to this test.');
            }
            $batches = $user->batches()->where('is_active', true)->get();
        } else {
            $batches = Batch::where('is_active', true)->get();
        }
        $subjects = Subject::where('is_active', true)->get();
        return view('tests.edit', compact('test', 'batches', 'subjects'));
    }

    public function update(Request $request, Test $test)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($test->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }
        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'test_date' => 'required|date',
            'total_marks' => 'required|integer|min:1',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        $test->update($validated);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $test->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getMimeType(),
                ]);
            }
        }

        return redirect()->route('tests.index')
            ->with('success', 'Test updated successfully.');
    }

    public function destroy(Test $test)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($test->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }
        $test->delete();
        return redirect()->route('tests.index')
            ->with('success', 'Test deleted successfully.');
    }

    // Marks Management
    public function marks(Test $test)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($test->batch_id, $batchIds)) {
                abort(403, 'Unauthorized access to marks management.');
            }
        }
        $test->load('batch.students');
        $scores = TestScore::where('test_id', $test->id)->get()->keyBy('student_id');

        return view('tests.marks', compact('test', 'scores'));
    }

    public function storeMarks(Request $request, Test $test)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($test->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $validated = $request->validate([
            'scores' => 'required|array',
            'scores.*.score' => 'nullable|numeric|min:0|max:' . $test->total_marks,
            'scores.*.remarks' => 'nullable|string',
        ]);

        $students = Student::whereIn('id', array_keys($validated['scores']))->with('institute')->get()->keyBy('id');
        $subject = Subject::find($test->subject_id);
        $subjectName = $subject->name ?? 'Subject';
        $sentCount = 0;

        foreach ($validated['scores'] as $studentId => $data) {
            if ($data['score'] !== null) {
                TestScore::updateOrCreate(
                    [
                        'test_id' => $test->id,
                        'student_id' => $studentId,
                    ],
                    [
                        'score' => $data['score'],
                        'remarks' => $data['remarks'] ?? null,
                    ]
                );

                if (isset($students[$studentId])) {
                    $student = $students[$studentId];
                    if ($student->phone) {
                        $instituteName = $student->institute->name ?? 'EduNex ERP';
                        $remarksPart = !empty($data['remarks']) ? "\nRemarks: " . $data['remarks'] : "";
                        $message = "Dear Parent/Student,\n\nTest results are out! *{$student->name}* scored *{$data['score']} / {$test->total_marks}* in the test *'{$test->title}'* ({$subjectName}).{$remarksPart}\n\nKeep up the effort!\n— *{$instituteName}*";

                        if (\App\Services\WhatsAppService::sendWhatsApp($student->name, $student->phone, $message, 'exam_marks')) {
                            $sentCount++;
                        }
                    }
                }
            }
        }

        $mode = \App\Services\WhatsAppService::getSettings()['mode'] ?? 'simulator';
        $statusText = $mode === 'simulator' ? 'simulated and logged' : 'sent';

        return redirect()->route('tests.index')
            ->with('success', "Test marks saved successfully and {$sentCount} WhatsApp alerts {$statusText}.");
    }
}
