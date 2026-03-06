<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Student;
use App\Notifications\CustomPortalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function sendPortalAlert(Student $student)
    {
        $student->notify(new \App\Notifications\FeeReminderNotification());
        return back()->with('success', 'Portal alert sent successfully to ' . $student->name);
    }

    public function index()
    {
        $students = Student::where('is_active', true)->orderBy('name')->get();
        $batches = Batch::where('is_active', true)->orderBy('name')->get();

        // Last 30 sent portal notifications across all students of this institute
        $history = DB::table('notifications')
            ->join('students', 'notifications.notifiable_id', '=', 'students.id')
            ->where('notifications.notifiable_type', 'App\\Models\\Student')
            ->where('students.institute_id', auth()->user()->institute_id)
            ->select('notifications.*', 'students.name as student_name')
            ->orderBy('notifications.created_at', 'desc')
            ->limit(30)
            ->get()
            ->map(function ($n) {
            $n->data = json_decode($n->data, true);
            return $n;
        });

        return view('notifications.index', compact('students', 'batches', 'history'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'type' => 'required|in:student,general',
            'student_id' => 'required_if:type,student|nullable|exists:students,id',
            'batch_id' => 'nullable|exists:batches,id',
            'title' => 'required|string|max:100',
            'message' => 'required|string|max:500',
            'icon' => 'required|string',
            'color' => 'required|in:primary,success,warning,danger',
        ]);

        $notification = new CustomPortalNotification(
            $request->title,
            $request->message,
            $request->icon,
            $request->color,
            );

        if ($request->type === 'student') {
            // Send to one specific student
            $student = Student::findOrFail($request->student_id);
            $student->notify($notification);
            $count = 1;
        }
        else {
            // General: filter by batch or all active students
            $query = Student::where('is_active', true);
            if ($request->batch_id) {
                $query->where('batch_id', $request->batch_id);
            }
            $recipients = $query->get();
            foreach ($recipients as $student) {
                $student->notify(clone $notification);
            }
            $count = $recipients->count();
        }

        return back()->with('success', "Notification sent to {$count} student(s) successfully.");
    }
}
