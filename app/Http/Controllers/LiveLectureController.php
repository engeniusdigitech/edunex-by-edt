<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\LiveLecture;
use App\Models\Subject;
use Illuminate\Http\Request;

class LiveLectureController extends Controller
{
    /**
     * Display a listing of live lectures.
     */
    public function index()
    {
        $user = auth()->user();
        $query = LiveLecture::with('batch');

        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id');
            $query->whereIn('batch_id', $batchIds);
        }

        $lectures = $query->latest()->paginate(10);
        return view('live_lectures.index', compact('lectures'));
    }

    /**
     * Show the form for creating / scheduling a new live lecture.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batches = $user->batches()->where('is_active', true)->get();
        } else {
            $batches = Batch::where('is_active', 1)->get();
        }
        $subjects = Subject::where('is_active', 1)->get();
        return view('live_lectures.create', compact('batches', 'subjects'));
    }

    /**
     * Schedule the lecture (saves it as 'scheduled').
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($request->batch_id, $batchIds)) {
                return back()->withErrors(['batch_id' => 'You can only schedule lectures for your own batches.']);
            }
        }

        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $roomName = LiveLecture::generateRoomName($request->title);

        LiveLecture::create([
            'batch_id' => $request->batch_id,
            'subject' => $request->subject,
            'title' => $request->title,
            'description' => $request->description,
            'room_name' => $roomName,
            'status' => 'scheduled',
        ]);

        return redirect()->route('live-lectures.index')
            ->with('success', 'Lecture scheduled successfully. Click "Start" when ready to go live!');
    }

    /**
     * Mark a lecture as LIVE and open the Jitsi room for the teacher.
     */
    public function start(LiveLecture $liveLecture)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($liveLecture->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $liveLecture->update([
            'status' => 'live',
            'recorded_at' => now()->toDateString(),
        ]);

        return view('live_lectures.room', [
            'liveLecture' => $liveLecture,
            'isHost' => true,
        ]);
    }

    /**
     * Mark a lecture as ENDED.
     */
    public function end(LiveLecture $liveLecture)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($liveLecture->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $liveLecture->update(['status' => 'ended']);

        return redirect()->route('live-lectures.index')
            ->with('success', 'Lecture ended and saved to the library.');
    }

    /**
     * Show edit form (only for scheduled lectures to update details).
     */
    public function edit(LiveLecture $liveLecture)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($liveLecture->batch_id, $batchIds)) {
                abort(403, 'Unauthorized access to this lecture.');
            }
            $batches = $user->batches()->where('is_active', true)->get();
        } else {
            $batches = Batch::where('is_active', 1)->get();
        }
        $subjects = Subject::where('is_active', 1)->get();
        return view('live_lectures.edit', compact('liveLecture', 'batches', 'subjects'));
    }

    /**
     * Update lecture details.
     */
    public function update(Request $request, LiveLecture $liveLecture)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($liveLecture->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }

        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $liveLecture->update($request->only('batch_id', 'subject', 'title', 'description'));

        return redirect()->route('live-lectures.index')
            ->with('success', 'Lecture details updated successfully.');
    }

    /**
     * Delete a lecture record.
     */
    public function destroy(LiveLecture $liveLecture)
    {
        $user = auth()->user();
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($liveLecture->batch_id, $batchIds)) {
                abort(403, 'Unauthorized action.');
            }
        }

        if ($liveLecture->video_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($liveLecture->video_path)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($liveLecture->video_path);
        }
        $liveLecture->delete();

        return redirect()->route('live-lectures.index')
            ->with('success', 'Lecture deleted successfully.');
    }
}
