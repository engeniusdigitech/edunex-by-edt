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
    public function index()
    {
        $tests = Test::with(['batch', 'subject'])->latest()->get();
        return view('tests.index', compact('tests'));
    }

    public function create()
    {
        $batches = Batch::where('is_active', true)->get();
        $subjects = Subject::where('is_active', true)->get();
        return view('tests.create', compact('batches', 'subjects'));
    }

    public function store(Request $request)
    {
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
        $students = \App\Models\Student::where('batch_id', $test->batch_id)->get();
        if ($students->count() > 0) {
            \Illuminate\Support\Facades\Notification::send($students, new \App\Notifications\NewTestNotification($test));
        }

        return redirect()->route('tests.index')
            ->with('success', 'Test scheduled successfully and students notified.');
    }

    public function edit(Test $test)
    {
        $batches = Batch::where('is_active', true)->get();
        $subjects = Subject::where('is_active', true)->get();
        return view('tests.edit', compact('test', 'batches', 'subjects'));
    }

    public function update(Request $request, Test $test)
    {
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
        $test->delete();
        return redirect()->route('tests.index')
            ->with('success', 'Test deleted successfully.');
    }

    // Marks Management
    public function marks(Test $test)
    {
        $test->load('batch.students');
        $scores = TestScore::where('test_id', $test->id)->get()->keyBy('student_id');

        return view('tests.marks', compact('test', 'scores'));
    }

    public function storeMarks(Request $request, Test $test)
    {
        $validated = $request->validate([
            'scores' => 'required|array',
            'scores.*.score' => 'nullable|numeric|min:0|max:' . $test->total_marks,
            'scores.*.remarks' => 'nullable|string',
        ]);

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
            }
        }

        return redirect()->route('tests.index')
            ->with('success', 'Test marks saved successfully.');
    }
}
