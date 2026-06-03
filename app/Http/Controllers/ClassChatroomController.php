<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\ClassChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassChatroomController extends Controller
{
    /**
     * Display the class chatroom dashboard with available batches.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get batches based on role
        if ($user->isInstituteAdmin() || $user->isPrincipal()) {
            $batches = Batch::where('is_active', true)->get();
        } elseif ($user->isTeacher()) {
            $batches = Batch::where('class_teacher_id', $user->id)
                ->where('is_active', true)
                ->get();
        } else {
            abort(403, 'Unauthorized access to Class Chatroom.');
        }

        $selectedBatchId = $request->get('batch_id');
        $selectedBatch = null;

        if ($selectedBatchId) {
            $selectedBatch = $batches->firstWhere('id', $selectedBatchId);
        }

        // If no batch selected but we have batches, select the first one
        if (!$selectedBatch && $batches->isNotEmpty()) {
            $selectedBatch = $batches->first();
        }

        return view('class_chat.index', compact('batches', 'selectedBatch'));
    }

    /**
     * Get JSON response of messages for the selected batch.
     */
    public function fetchMessages(Batch $batch)
    {
        $this->authorizeAccess($batch);

        $messages = ClassChatMessage::where('batch_id', $batch->id)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($msg) {
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
                    'is_me' => ($msg->sender_id === Auth::id() && $msg->sender_type === \App\Models\User::class),
                    'time' => $msg->created_at->format('h:i A'),
                ];
            });

        return response()->json([
            'messages' => $messages,
        ]);
    }

    /**
     * Store a message in the database.
     */
    public function sendMessage(Request $request, Batch $batch)
    {
        $this->authorizeAccess($batch);

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $msg = ClassChatMessage::create([
            'institute_id' => Auth::user()->institute_id,
            'batch_id' => $batch->id,
            'sender_type' => \App\Models\User::class,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id,
                'message' => $msg->message,
                'sender_name' => Auth::user()->name,
                'sender_avatar' => Auth::user()->profile_image_url,
                'sender_role' => Auth::user()->role->name ?? 'Staff',
                'is_me' => true,
                'time' => $msg->created_at->format('h:i A'),
            ]
        ]);
    }

    /**
     * Check if user has permission to access the batch chat.
     */
    protected function authorizeAccess(Batch $batch)
    {
        $user = Auth::user();

        if ($user->isInstituteAdmin() || $user->isPrincipal()) {
            return true;
        }

        if ($user->isTeacher() && $batch->class_teacher_id === $user->id) {
            return true;
        }

        abort(403, 'You do not have access to this class chatroom.');
    }
}
