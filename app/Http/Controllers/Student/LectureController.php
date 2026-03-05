<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();

        // Fetch lectures for the student's batch, latest first
        $lectures = \App\Models\LiveLecture::where('batch_id', $student->batch_id)
            ->latest('recorded_at')
            ->get();

        // Group by subject in PHP (quicker than complex DB grouping for typical lecture counts)
        $groupedLectures = $lectures->groupBy('subject');

        return view('student.lectures.index', compact('groupedLectures'));
    }

    public function download(\App\Models\LiveLecture $liveLecture)
    {
        // Ensure student has access to this lecture
        if ($liveLecture->batch_id !== auth('student')->user()->batch_id) {
            abort(403);
        }

        if (!\Illuminate\Support\Facades\Storage::disk('public')->exists($liveLecture->video_path)) {
            return back()->with('error', 'Video file not found.');
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->download($liveLecture->video_path, $liveLecture->title . '.' . pathinfo($liveLecture->video_path, PATHINFO_EXTENSION));
    }
}
