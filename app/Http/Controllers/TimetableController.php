<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Subject;
use App\Models\User;
use App\Models\TimetableSlot;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimetableController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->isTeacher()) {
            return redirect()->route('timetables.my-schedule');
        }

        $user = auth()->user();
        $batches = Batch::where('institute_id', $user->institute_id)->get();
        
        $selectedBatchId = $request->get('batch_id', $batches->first()?->id);
        $slots = [];

        if ($selectedBatchId) {
            $slots = TimetableSlot::where('batch_id', $selectedBatchId)
                ->with(['subject', 'teacher'])
                ->get();
        }

        $teachers = User::where('institute_id', $user->institute_id)
            ->whereIn('role_id', [2, 3]) // Assuming 2: Principal, 3: Teacher
            ->get();
            
        $subjects = Subject::where('institute_id', $user->institute_id)->get();

        return view('timetables.index', compact('batches', 'slots', 'selectedBatchId', 'teachers', 'subjects'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isInstituteAdmin() && !auth()->user()->isPrincipal() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'You are not authorized to manage the timetable.');
        }

        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'subject_id' => 'required|exists:subjects,id',
            'user_id' => 'required|exists:users,id',
            'day' => 'required|integer|between:1,7',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'room_number' => 'nullable|string',
        ]);

        $institute_id = auth()->user()->institute_id;
        $startTime = $request->start_time;
        $endTime = $request->end_time;
        $day = $request->day;

        // Conflict 1: Teacher double-booking
        $teacherConflict = TimetableSlot::where('user_id', $request->user_id)
            ->where('day', $day)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
                });
            })->first();

        if ($teacherConflict) {
            return back()->with('error', "Teacher is already busy in Batch: {$teacherConflict->batch->name} between {$teacherConflict->start_time} and {$teacherConflict->end_time}.");
        }

        // Conflict 2: Batch double-booking
        $batchConflict = TimetableSlot::where('batch_id', $request->batch_id)
            ->where('day', $day)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                      ->where('end_time', '>', $startTime);
                });
            })->first();

        if ($batchConflict) {
            return back()->with('error', "Batch already has a scheduled class ({$batchConflict->subject->name}) at this time.");
        }

        TimetableSlot::create([
            'institute_id' => $institute_id,
            'batch_id' => $request->batch_id,
            'subject_id' => $request->subject_id,
            'user_id' => $request->user_id,
            'day' => $day,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'room_number' => $request->room_number,
        ]);

        return back()->with('success', 'Timetable slot added successfully.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->isInstituteAdmin() && !auth()->user()->isPrincipal() && !auth()->user()->isSuperAdmin()) {
            return back()->with('error', 'You are not authorized to manage the timetable.');
        }

        $slot = TimetableSlot::findOrFail($id);
        $slot->delete();
        return back()->with('success', 'Slot removed from timetable.');
    }

    public function mySchedule()
    {
        $user = auth()->user();
        
        // If teacher, show their teaching hours
        $slots = TimetableSlot::where('user_id', $user->id)
            ->with(['batch', 'subject'])
            ->get()
            ->groupBy('day');

        return view('timetables.my-schedule', compact('slots'));
    }
}
