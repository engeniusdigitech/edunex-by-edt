<?php

namespace App\Http\Controllers;

use App\Models\QuestionBank;
use App\Models\Subject;
use App\Models\Batch;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    public function index(Request $request)
    {
        $query = QuestionBank::with(['subject', 'batch']);

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->difficulty);
        }
        if ($request->filled('search')) {
            $query->where('question', 'like', '%' . $request->search . '%');
        }

        $questions = $query->latest()->paginate(20);
        $subjects  = Subject::where('is_active', true)->get();
        $batches   = Batch::where('is_active', true)->get();

        return view('question-bank.index', compact('questions', 'subjects', 'batches'));
    }

    public function create()
    {
        $subjects = Subject::where('is_active', true)->get();
        $batches  = Batch::where('is_active', true)->get();
        return view('question-bank.create', compact('subjects', 'batches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id'     => 'required|exists:subjects,id',
            'batch_id'       => 'nullable|exists:batches,id',
            'question'       => 'required|string',
            'type'           => 'required|in:mcq,true_false',
            'option_a'       => 'required|string|max:500',
            'option_b'       => 'required|string|max:500',
            'option_c'       => 'nullable|string|max:500',
            'option_d'       => 'nullable|string|max:500',
            'correct_option' => 'required|in:a,b,c,d',
            'marks'          => 'required|integer|min:1|max:100',
            'difficulty'     => 'required|in:easy,medium,hard',
            'explanation'    => 'nullable|string',
        ]);

        QuestionBank::create($validated);

        if ($request->has('add_another')) {
            return redirect()->route('question-bank.create')
                ->with('success', 'Question added! Add another.');
        }

        return redirect()->route('question-bank.index')
            ->with('success', 'Question added to bank successfully.');
    }

    public function edit(QuestionBank $questionBank)
    {
        $subjects = Subject::where('is_active', true)->get();
        $batches  = Batch::where('is_active', true)->get();
        return view('question-bank.edit', compact('questionBank', 'subjects', 'batches'));
    }

    public function update(Request $request, QuestionBank $questionBank)
    {
        $validated = $request->validate([
            'subject_id'     => 'required|exists:subjects,id',
            'batch_id'       => 'nullable|exists:batches,id',
            'question'       => 'required|string',
            'type'           => 'required|in:mcq,true_false',
            'option_a'       => 'required|string|max:500',
            'option_b'       => 'required|string|max:500',
            'option_c'       => 'nullable|string|max:500',
            'option_d'       => 'nullable|string|max:500',
            'correct_option' => 'required|in:a,b,c,d',
            'marks'          => 'required|integer|min:1|max:100',
            'difficulty'     => 'required|in:easy,medium,hard',
            'explanation'    => 'nullable|string',
        ]);

        $questionBank->update($validated);

        return redirect()->route('question-bank.index')
            ->with('success', 'Question updated successfully.');
    }

    public function destroy(QuestionBank $questionBank)
    {
        $questionBank->delete();
        return redirect()->route('question-bank.index')
            ->with('success', 'Question deleted from bank.');
    }
}
