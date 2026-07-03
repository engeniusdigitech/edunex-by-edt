<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function index(Request $request)
    {
        $homework = collect();
        if (class_exists(\App\Models\Homework::class)) {
            $homework = \App\Models\Homework::with(['subject', 'batch'])
                ->where('created_by', $request->user()->id)
                ->latest()
                ->get()
                ->map(fn($h) => [
                    'id' => $h->id,
                    'title' => $h->title,
                    'subject' => $h->subject?->name ?? '',
                    'batch' => $h->batch?->name ?? '',
                    'due_date' => optional($h->due_date)->format('Y-m-d'),
                    'description' => $h->description ?? null,
                ])->values();
        }
        return response()->json(['homework' => $homework]);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'subject_id' => 'required', 'batch_id' => 'required', 'due_date' => 'required|date']);
        if (class_exists(\App\Models\Homework::class)) {
            \App\Models\Homework::create(array_merge($request->validated(), ['created_by' => $request->user()->id]));
        }
        return response()->json(['message' => 'Homework created successfully'], 201);
    }
}
