<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        $homeworks = Homework::where('batch_id', $student->batch_id)
            ->with(['subject', 'attachments'])
            ->latest('due_date')
            ->get();

        return response()->json([
            'homeworks' => $homeworks->map(function ($hw) {
                return [
                    'id' => $hw->id,
                    'title' => $hw->title,
                    'description' => $hw->description,
                    'subject' => $hw->subject ? $hw->subject->name : null,
                    'due_date' => $hw->due_date ? $hw->due_date->format('Y-m-d') : null,
                    'attachments' => $hw->attachments->map(function ($attachment) {
                        return [
                            'id' => $attachment->id,
                            'name' => $attachment->original_name,
                            'url' => asset('storage/' . $attachment->file_path),
                        ];
                    }),
                ];
            })
        ]);
    }
}
