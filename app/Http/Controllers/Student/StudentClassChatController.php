<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\ClassChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentClassChatController extends Controller
{
    /**
     * Display the student class chatroom.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();

        if (!$student->batch_id) {
            return redirect()->route('student.dashboard')->with('error', 'You are not assigned to any class/batch.');
        }

        $batch = Batch::findOrFail($student->batch_id);

        return view('student.class_chat.index', compact('batch'));
    }

    /**
     * Fetch messages JSON for student's batch.
     */
    public function fetchMessages()
    {
        $student = Auth::guard('student')->user();

        if (!$student->batch_id) {
            return response()->json(['messages' => []]);
        }

        $messages = ClassChatMessage::where('batch_id', $student->batch_id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) use ($student) {
                $senderName = 'Unknown';
                $senderAvatar = '';
                $senderRole = '';

                if ($msg->sender) {
                    $senderName = $msg->sender->name;
                    $senderAvatar = $msg->sender->profile_image_url;

                    if ($msg->sender_type === \App\Models\User::class) {
                        $senderRole = $msg->sender->role->name ?? 'Staff';
                    } else {
                        $senderRole = 'Student';
                    }
                }

                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'sender_id' => $msg->sender_id,
                    'sender_type' => $msg->sender_type,
                    'sender_name' => $senderName,
                    'sender_avatar' => $senderAvatar,
                    'sender_role' => $senderRole,
                    'is_me' => ($msg->sender_id === $student->id && $msg->sender_type === \App\Models\Student::class),
                    'time' => $msg->created_at->format('h:i A'),
                ];
            });

        return response()->json([
            'messages' => $messages,
        ]);
    }

    /**
     * Send a message to student's batch chatroom.
     */
    public function sendMessage(Request $request)
    {
        $student = Auth::guard('student')->user();

        if (!$student->batch_id) {
            return response()->json(['error' => 'No batch assigned'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $msg = ClassChatMessage::create([
            'institute_id' => $student->institute_id,
            'batch_id' => $student->batch_id,
            'sender_type' => \App\Models\Student::class,
            'sender_id' => $student->id,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id,
                'message' => $msg->message,
                'sender_name' => $student->name,
                'sender_avatar' => $student->profile_image_url,
                'sender_role' => 'Student',
                'is_me' => true,
                'time' => $msg->created_at->format('h:i A'),
            ]
        ]);
    }
}
