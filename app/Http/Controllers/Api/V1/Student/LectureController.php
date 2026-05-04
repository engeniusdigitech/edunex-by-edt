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
            ->latest()
            ->get();

        return response()->json([
            'lectures' => $lectures->map(function ($lecture) {
                return [
                    'id' => $lecture->id,
                    'topic' => $lecture->title,
                    'description' => $lecture->description,
                    'subject' => $lecture->subject,
                    'start_time' => $lecture->created_at ? $lecture->created_at->toDateTimeString() : null,
                    'end_time' => null,
                    'status' => $lecture->status,
                    'meeting_link' => $lecture->getJitsiRoomUrl(),
                ];
            })
        ]);
    }
}
