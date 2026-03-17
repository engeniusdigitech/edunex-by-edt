<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\LiveLecture;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        // Fetch lectures for the student's batch
        $lectures = LiveLecture::where('batch_id', $student->batch_id)
            ->with('subject')
            ->latest()
            ->get();

        return response()->json([
            'lectures' => $lectures->map(function ($lecture) {
                return [
                    'id' => $lecture->id,
                    'topic' => $lecture->topic,
                    'description' => $lecture->description,
                    'subject' => $lecture->subject->name,
                    'start_time' => $lecture->start_time->toDateTimeString(),
                    'end_time' => $lecture->end_time ? $lecture->end_time->toDateTimeString() : null,
                    'status' => $lecture->status,
                    'meeting_link' => $lecture->meeting_link,
                ];
            })
        ]);
    }
}
