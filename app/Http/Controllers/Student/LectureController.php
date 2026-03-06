<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\LiveLecture;

class LectureController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();

        // Fetch LIVE sessions for the student's batch
        $liveLectures = LiveLecture::where('batch_id', $student->batch_id)
            ->where('status', 'live')
            ->latest()
            ->get();

        // Fetch ENDED sessions (recording library) grouped by subject
        $endedLectures = LiveLecture::where('batch_id', $student->batch_id)
            ->where('status', 'ended')
            ->latest('recorded_at')
            ->get();

        $groupedLectures = $endedLectures->groupBy('subject');

        return view('student.lectures.index', compact('liveLectures', 'groupedLectures'));
    }

    public function join(LiveLecture $liveLecture)
    {
        $student = auth('student')->user();

        // Ensure lecture is still live and belongs to the student's batch
        if ($liveLecture->batch_id !== $student->batch_id) {
            abort(403, 'You do not have access to this lecture.');
        }

        if (!$liveLecture->isLive()) {
            return redirect()->route('student.lectures.index')
                ->with('error', 'This lecture has already ended.');
        }

        return view('student.lectures.room', [
            'liveLecture' => $liveLecture,
        ]);
    }

    public function download(LiveLecture $liveLecture)
    {
        $student = auth('student')->user();

        if ($liveLecture->batch_id !== $student->batch_id) {
            abort(403);
        }

        if (!$liveLecture->video_path || !\Illuminate\Support\Facades\Storage::disk('public')->exists($liveLecture->video_path)) {
            return back()->with('error', 'Video file not found.');
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->download(
            $liveLecture->video_path,
            $liveLecture->title . '.' . pathinfo($liveLecture->video_path, PATHINFO_EXTENSION)
        );
    }
}
