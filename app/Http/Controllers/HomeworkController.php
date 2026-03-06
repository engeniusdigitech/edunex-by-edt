<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Batch;
use App\Models\Subject;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function index()
    {
        $homeworks = Homework::with(['batch', 'subject'])->latest()->get();
        return view('homework.index', compact('homeworks'));
    }

    public function create()
    {
        $batches = Batch::where('is_active', true)->get();
        $subjects = Subject::where('is_active', true)->get();
        return view('homework.create', compact('batches', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
        ]);

        $homework = Homework::create($validated);

        // Notify all students in this batch
        $students = \App\Models\Student::where('batch_id', $homework->batch_id)->get();
        if ($students->count() > 0) {
            \Illuminate\Support\Facades\Notification::send($students, new \App\Notifications\NewHomeworkNotification($homework));
        }

        return redirect()->route('homework.index')
            ->with('success', 'Homework assigned successfully and students notified.');
    }

    public function edit(Homework $homework)
    {
        $batches = Batch::where('is_active', true)->get();
        $subjects = Subject::where('is_active', true)->get();
        return view('homework.edit', compact('homework', 'batches', 'subjects'));
    }

    public function update(Request $request, Homework $homework)
    {
        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $homework->update($validated);

        return redirect()->route('homework.index')
            ->with('success', 'Homework updated successfully.');
    }

    public function destroy(Homework $homework)
    {
        $homework->delete();
        return redirect()->route('homework.index')
            ->with('success', 'Homework deleted successfully.');
    }
}
