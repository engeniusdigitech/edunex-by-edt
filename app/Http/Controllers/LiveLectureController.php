<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LiveLectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lectures = \App\Models\LiveLecture::with('batch')->latest()->paginate(10);
        return view('live_lectures.index', compact('lectures'));
    }

    public function create()
    {
        $batches = \App\Models\Batch::active()->get();
        return view('live_lectures.create', compact('batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'required|file|mimes:mp4,mov,avi,wmv,mkv|max:512000', // max 500MB
            'recorded_at' => 'required|date',
        ]);

        $videoPath = $request->file('video_file')->store('live_lectures', 'public');

        \App\Models\LiveLecture::create([
            'institute_id' => auth()->user()->institute_id,
            'batch_id' => $request->batch_id,
            'subject' => $request->subject,
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $videoPath,
            'recorded_at' => $request->recorded_at,
        ]);

        return redirect()->route('live-lectures.index')->with('success', 'Live lecture uploaded successfully.');
    }

    public function show(string $id)
    {
    // Unused
    }

    public function edit(\App\Models\LiveLecture $liveLecture)
    {
        $batches = \App\Models\Batch::active()->get();
        return view('live_lectures.edit', compact('liveLecture', 'batches'));
    }

    public function update(Request $request, \App\Models\LiveLecture $liveLecture)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,mov,avi,wmv,mkv|max:512000',
            'recorded_at' => 'required|date',
        ]);

        $data = $request->except('video_file');

        if ($request->hasFile('video_file')) {
            if ($liveLecture->video_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($liveLecture->video_path)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($liveLecture->video_path);
            }
            $data['video_path'] = $request->file('video_file')->store('live_lectures', 'public');
        }

        $liveLecture->update($data);

        return redirect()->route('live-lectures.index')->with('success', 'Live lecture updated successfully.');
    }

    public function destroy(\App\Models\LiveLecture $liveLecture)
    {
        if ($liveLecture->video_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($liveLecture->video_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($liveLecture->video_path);
        }
        $liveLecture->delete();

        return redirect()->route('live-lectures.index')->with('success', 'Live lecture deleted successfully.');
    }
}
