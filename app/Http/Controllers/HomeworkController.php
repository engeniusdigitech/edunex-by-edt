<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Batch;
use App\Models\Subject;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Homework::with(['batch', 'subject']);

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

        $homeworks = $query->latest()->paginate(15);
        $subjects = Subject::where('is_active', true)->get();

        return view('homework.index', compact('homeworks', 'batches', 'subjects'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batches = $user->batches()->where('is_active', true)->get();
            $subjects = Subject::where('is_active', true)->get(); // Keep global or filter if assigned
        } else {
            $batches = Batch::where('is_active', true)->get();
            $subjects = Subject::where('is_active', true)->get();
        }
        return view('homework.create', compact('batches', 'subjects'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($request->batch_id, $batchIds)) {
                return back()->withErrors(['batch_id' => 'You can only assign homework to your own batches.']);
            }
        }

        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date|after_or_equal:today',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        $homework = Homework::create($validated);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $homework->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getMimeType(),
                ]);
            }
        }

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
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($homework->batch_id, $batchIds)) {
                abort(403, 'Unauthorized access to this homework.');
            }
            $batches = $user->batches()->where('is_active', true)->get();
        } else {
            $batches = Batch::where('is_active', true)->get();
        }
        $subjects = Subject::where('is_active', true)->get();

        return view('homework.edit', compact('homework', 'batches', 'subjects'));
    }

    public function update(Request $request, Homework $homework)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($homework->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }
        $validated = $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:10240',
        ]);

        $homework->update($validated);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $homework->attachments()->create([
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'file_size' => $file->getSize(),
                    'file_type' => $file->getMimeType(),
                ]);
            }
        }

        return redirect()->route('homework.index')
            ->with('success', 'Homework updated successfully.');
    }

    public function destroy(Homework $homework)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($homework->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $homework->delete();
        return redirect()->route('homework.index')
            ->with('success', 'Homework deleted successfully.');
    }
}
