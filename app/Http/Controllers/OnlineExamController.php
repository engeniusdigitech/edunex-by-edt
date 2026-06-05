<?php

namespace App\Http\Controllers;

use App\Models\OnlineExam;
use App\Models\OnlineExamQuestion;
use App\Models\QuestionBank;
use App\Models\Batch;
use App\Models\Subject;
use Illuminate\Http\Request;

class OnlineExamController extends Controller
{
    public function index(Request $request)
    {
        $user  = auth()->user();
        $query = OnlineExam::with(['batch', 'subject', 'sessions']);

        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id');
            $query->whereIn('batch_id', $batchIds);
            $batches = $user->batches()->where('is_active', true)->get();
        } else {
            $batches = Batch::where('is_active', true)->get();
        }

        if ($request->filled('batch_id'))  $query->where('batch_id', $request->batch_id);
        if ($request->filled('status'))    $query->where('status', $request->status);
        if ($request->filled('search'))    $query->where('title', 'like', '%'.$request->search.'%');

        $exams    = $query->latest()->paginate(15);
        $subjects = Subject::where('is_active', true)->get();

        return view('online-exams.index', compact('exams', 'batches', 'subjects'));
    }

    public function create()
    {
        $user = auth()->user();
        $batches  = $user->isTeacher()
            ? $user->batches()->where('is_active', true)->get()
            : Batch::where('is_active', true)->get();
        $subjects = Subject::where('is_active', true)->get();
        return view('online-exams.create', compact('batches', 'subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'batch_id'                => 'required|exists:batches,id',
            'subject_id'              => 'required|exists:subjects,id',
            'title'                   => 'required|string|max:255',
            'description'             => 'nullable|string',
            'instructions'            => 'nullable|string',
            'start_datetime'          => 'required|date',
            'end_datetime'            => 'required|date|after:start_datetime',
            'duration_minutes'        => 'required|integer|min:1|max:480',
            'pass_percentage'         => 'required|integer|min:1|max:100',
            'shuffle_questions'       => 'boolean',
            'show_result_immediately' => 'boolean',
            'allow_review'            => 'boolean',
        ]);

        $validated['created_by']              = auth()->id();
        $validated['shuffle_questions']       = $request->boolean('shuffle_questions');
        $validated['show_result_immediately'] = $request->boolean('show_result_immediately');
        $validated['allow_review']            = $request->boolean('allow_review');

        $exam = OnlineExam::create($validated);

        return redirect()->route('online-exams.questions', $exam)
            ->with('success', 'Exam created! Now add questions.');
    }

    public function edit(OnlineExam $onlineExam)
    {
        $user = auth()->user();
        $batches  = $user->isTeacher()
            ? $user->batches()->where('is_active', true)->get()
            : Batch::where('is_active', true)->get();
        $subjects = Subject::where('is_active', true)->get();
        return view('online-exams.edit', compact('onlineExam', 'batches', 'subjects'));
    }

    public function update(Request $request, OnlineExam $onlineExam)
    {
        $validated = $request->validate([
            'batch_id'                => 'required|exists:batches,id',
            'subject_id'              => 'required|exists:subjects,id',
            'title'                   => 'required|string|max:255',
            'description'             => 'nullable|string',
            'instructions'            => 'nullable|string',
            'start_datetime'          => 'required|date',
            'end_datetime'            => 'required|date|after:start_datetime',
            'duration_minutes'        => 'required|integer|min:1|max:480',
            'pass_percentage'         => 'required|integer|min:1|max:100',
            'shuffle_questions'       => 'boolean',
            'show_result_immediately' => 'boolean',
            'allow_review'            => 'boolean',
        ]);

        $validated['shuffle_questions']       = $request->boolean('shuffle_questions');
        $validated['show_result_immediately'] = $request->boolean('show_result_immediately');
        $validated['allow_review']            = $request->boolean('allow_review');

        $onlineExam->update($validated);

        return redirect()->route('online-exams.index')
            ->with('success', 'Exam updated successfully.');
    }

    public function destroy(OnlineExam $onlineExam)
    {
        $onlineExam->delete();
        return redirect()->route('online-exams.index')
            ->with('success', 'Exam deleted.');
    }

    // ─── Question Manager ───────────────────────────────────────────────────

    public function questions(OnlineExam $onlineExam, Request $request)
    {
        $onlineExam->load('questions');

        $bankQuery = QuestionBank::with('subject')
            ->where('subject_id', $onlineExam->subject_id);

        if ($request->filled('difficulty')) {
            $bankQuery->where('difficulty', $request->difficulty);
        }
        if ($request->filled('bank_search')) {
            $bankQuery->where('question', 'like', '%'.$request->bank_search.'%');
        }

        // Exclude already-added questions from bank list
        $addedBankIds = $onlineExam->questions()->pluck('question_bank_id')->filter();
        $bankQuestions = $bankQuery->whereNotIn('id', $addedBankIds)->get();

        return view('online-exams.questions', compact('onlineExam', 'bankQuestions'));
    }

    public function addQuestion(Request $request, OnlineExam $onlineExam)
    {
        if ($request->filled('question_bank_id')) {
            // Add from bank
            $bank = QuestionBank::findOrFail($request->question_bank_id);
            $onlineExam->questions()->create([
                'question_bank_id' => $bank->id,
                'question'         => $bank->question,
                'option_a'         => $bank->option_a,
                'option_b'         => $bank->option_b,
                'option_c'         => $bank->option_c,
                'option_d'         => $bank->option_d,
                'correct_option'   => $bank->correct_option,
                'marks'            => $bank->marks,
                'order'            => $onlineExam->questions()->count(),
            ]);
        } else {
            // Add directly
            $validated = $request->validate([
                'question'       => 'required|string',
                'option_a'       => 'required|string|max:500',
                'option_b'       => 'required|string|max:500',
                'option_c'       => 'nullable|string|max:500',
                'option_d'       => 'nullable|string|max:500',
                'correct_option' => 'required|in:a,b,c,d',
                'marks'          => 'required|integer|min:1',
            ]);
            $validated['order'] = $onlineExam->questions()->count();
            $onlineExam->questions()->create($validated);
        }

        $onlineExam->recalculateTotalMarks();

        return redirect()->route('online-exams.questions', $onlineExam)
            ->with('success', 'Question added.');
    }

    public function removeQuestion(OnlineExam $onlineExam, OnlineExamQuestion $question)
    {
        $question->delete();
        $onlineExam->recalculateTotalMarks();
        return redirect()->route('online-exams.questions', $onlineExam)
            ->with('success', 'Question removed.');
    }

    // ─── Publish / Close ────────────────────────────────────────────────────

    public function publish(OnlineExam $onlineExam)
    {
        if ($onlineExam->questions()->count() === 0) {
            return back()->withErrors(['error' => 'Add at least one question before publishing.']);
        }
        $onlineExam->update(['status' => 'published']);
        return redirect()->route('online-exams.index')
            ->with('success', 'Exam published! Students can now take it.');
    }

    public function close(OnlineExam $onlineExam)
    {
        $onlineExam->update(['status' => 'closed']);
        return redirect()->route('online-exams.index')
            ->with('success', 'Exam closed.');
    }

    // ─── Results Analytics ──────────────────────────────────────────────────

    public function results(OnlineExam $onlineExam)
    {
        $onlineExam->load([
            'sessions.student',
            'sessions.answers.question',
            'questions',
        ]);

        $sessions    = $onlineExam->sessions()->where('status', 'submitted')
            ->with('student')->orderByDesc('score')->get();

        $totalStudents = $onlineExam->batch->students()->count();
        $attempted     = $sessions->count();
        $passed        = $sessions->where('is_passed', true)->count();
        $avgScore      = $sessions->avg('score') ?? 0;
        $avgPct        = $onlineExam->total_marks > 0
            ? round(($avgScore / $onlineExam->total_marks) * 100, 1)
            : 0;

        // Score distribution for chart (0-9, 10-19, ... 90-100)
        $distribution = array_fill(0, 10, 0);
        foreach ($sessions as $s) {
            if ($onlineExam->total_marks > 0) {
                $bucket = min(9, (int)(($s->percentage ?? 0) / 10));
                $distribution[$bucket]++;
            }
        }

        // Per-question accuracy
        $questionStats = [];
        foreach ($onlineExam->questions as $q) {
            $total   = $q->answers()->count();
            $correct = $q->answers()->where('is_correct', true)->count();
            $questionStats[] = [
                'question' => $q->question,
                'total'    => $total,
                'correct'  => $correct,
                'accuracy' => $total > 0 ? round(($correct / $total) * 100) : 0,
            ];
        }

        return view('online-exams.results', compact(
            'onlineExam', 'sessions',
            'totalStudents', 'attempted', 'passed',
            'avgScore', 'avgPct', 'distribution', 'questionStats'
        ));
    }
}
