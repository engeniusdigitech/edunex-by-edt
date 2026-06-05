<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\OnlineExam;
use App\Models\OnlineExamSession;
use App\Models\OnlineExamAnswer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OnlineExamController extends Controller
{
    private function student()
    {
        return auth()->guard('student')->user();
    }

    public function index()
    {
        $student = $this->student();
        $now     = Carbon::now();

        $exams = OnlineExam::with(['subject', 'sessions' => function ($q) use ($student) {
            $q->where('student_id', $student->id);
        }])
        ->where('batch_id', $student->batch_id)
        ->where('status', 'published')
        ->where('end_datetime', '>', $now)
        ->latest('start_datetime')
        ->get();

        // Also grab closed exams student attempted
        $pastExams = OnlineExam::with(['subject', 'sessions' => function ($q) use ($student) {
            $q->where('student_id', $student->id);
        }])
        ->where('batch_id', $student->batch_id)
        ->where(function ($q) use ($now) {
            $q->where('status', 'closed')
              ->orWhere('end_datetime', '<=', $now);
        })
        ->latest('start_datetime')
        ->take(10)
        ->get()
        ->filter(fn($e) => $e->sessions->count() > 0);

        return view('student.online-exams.index', compact('exams', 'pastExams'));
    }

    public function start(Request $request, OnlineExam $onlineExam)
    {
        $student = $this->student();
        $now     = Carbon::now();

        // Guard checks
        abort_if($onlineExam->batch_id !== $student->batch_id, 403, 'Not your exam.');
        abort_if($onlineExam->status !== 'published', 403, 'Exam is not available.');
        abort_if($now->lt($onlineExam->start_datetime), 403, 'Exam has not started yet.');
        abort_if($now->gt($onlineExam->end_datetime),  403, 'Exam window has closed.');

        // Check for existing session
        $session = OnlineExamSession::where('online_exam_id', $onlineExam->id)
            ->where('student_id', $student->id)
            ->first();

        if ($session) {
            if ($session->status !== 'in_progress') {
                return redirect()->route('student.online-exams.result', $onlineExam)
                    ->with('info', 'You have already submitted this exam.');
            }
            return redirect()->route('student.online-exams.take', $onlineExam);
        }

        // Create new session
        $session = OnlineExamSession::create([
            'online_exam_id' => $onlineExam->id,
            'student_id'     => $student->id,
            'started_at'     => $now,
            'total_marks'    => $onlineExam->total_marks,
            'status'         => 'in_progress',
        ]);

        return redirect()->route('student.online-exams.take', $onlineExam);
    }

    public function take(OnlineExam $onlineExam)
    {
        $student = $this->student();
        $now     = Carbon::now();

        $session = OnlineExamSession::where('online_exam_id', $onlineExam->id)
            ->where('student_id', $student->id)
            ->firstOrFail();

        // If already submitted/timed out
        if ($session->status !== 'in_progress') {
            return redirect()->route('student.online-exams.result', $onlineExam);
        }

        // If time expired, auto-submit
        if ($session->remaining_seconds <= 0 || $now->gt($onlineExam->end_datetime)) {
            $this->doSubmit($session, $onlineExam);
            return redirect()->route('student.online-exams.result', $onlineExam)
                ->with('info', 'Time expired — your exam was automatically submitted.');
        }

        $questions = $onlineExam->shuffle_questions
            ? $onlineExam->questions()->inRandomOrder()->get()
            : $onlineExam->questions()->orderBy('order')->get();

        $answers = OnlineExamAnswer::where('online_exam_session_id', $session->id)
            ->get()->keyBy('online_exam_question_id');

        return view('student.online-exams.take', compact('onlineExam', 'session', 'questions', 'answers'));
    }

    public function saveAnswer(Request $request, OnlineExam $onlineExam)
    {
        $student = $this->student();
        $session = OnlineExamSession::where('online_exam_id', $onlineExam->id)
            ->where('student_id', $student->id)
            ->where('status', 'in_progress')
            ->firstOrFail();

        $request->validate([
            'question_id'     => 'required|exists:online_exam_questions,id',
            'selected_option' => 'nullable|in:a,b,c,d',
        ]);

        OnlineExamAnswer::updateOrCreate(
            [
                'online_exam_session_id'  => $session->id,
                'online_exam_question_id' => $request->question_id,
            ],
            ['selected_option' => $request->selected_option]
        );

        return response()->json(['saved' => true]);
    }

    public function trackTabSwitch(Request $request, OnlineExam $onlineExam)
    {
        $student = $this->student();
        $session = OnlineExamSession::where('online_exam_id', $onlineExam->id)
            ->where('student_id', $student->id)
            ->where('status', 'in_progress')
            ->first();

        if ($session) {
            $session->increment('tab_switch_count');
        }

        return response()->json(['count' => $session?->tab_switch_count ?? 0]);
    }

    public function submit(Request $request, OnlineExam $onlineExam)
    {
        $student = $this->student();
        $session = OnlineExamSession::where('online_exam_id', $onlineExam->id)
            ->where('student_id', $student->id)
            ->where('status', 'in_progress')
            ->firstOrFail();

        $this->doSubmit($session, $onlineExam);

        return redirect()->route('student.online-exams.result', $onlineExam)
            ->with('success', 'Exam submitted successfully!');
    }

    private function doSubmit(OnlineExamSession $session, OnlineExam $onlineExam): void
    {
        $score = 0;
        foreach ($onlineExam->questions as $question) {
            $answer = OnlineExamAnswer::where('online_exam_session_id', $session->id)
                ->where('online_exam_question_id', $question->id)
                ->first();

            if ($answer) {
                $isCorrect = ($answer->selected_option === $question->correct_option);
                $answer->update(['is_correct' => $isCorrect]);
                if ($isCorrect) $score += $question->marks;
            }
        }

        $totalMarks = $onlineExam->total_marks ?: 1;
        $percentage = round(($score / $totalMarks) * 100, 2);
        $isPassed   = $percentage >= $onlineExam->pass_percentage;

        $session->update([
            'score'        => $score,
            'total_marks'  => $onlineExam->total_marks,
            'percentage'   => $percentage,
            'is_passed'    => $isPassed,
            'submitted_at' => Carbon::now(),
            'status'       => 'submitted',
        ]);
    }

    public function result(OnlineExam $onlineExam)
    {
        $student = $this->student();
        $session = OnlineExamSession::where('online_exam_id', $onlineExam->id)
            ->where('student_id', $student->id)
            ->firstOrFail();

        abort_if($session->status === 'in_progress', 403, 'Exam not yet submitted.');

        $answers = null;
        if ($onlineExam->allow_review && $session->status === 'submitted') {
            $answers = OnlineExamAnswer::where('online_exam_session_id', $session->id)
                ->with('question.bankQuestion')
                ->get()
                ->keyBy('online_exam_question_id');
        }

        $rank = null;
        if ($onlineExam->show_result_immediately) {
            $rank = OnlineExamSession::where('online_exam_id', $onlineExam->id)
                ->where('status', 'submitted')
                ->where('score', '>', $session->score)
                ->count() + 1;
        }

        return view('student.online-exams.result', compact('onlineExam', 'session', 'answers', 'rank'));
    }
}
