<?php

namespace App\Http\Controllers\Api\V1\Chat;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\ClassChatMessage;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class ClassChatApiController extends Controller
{
    /**
     * Get list of batches (classes) the logged-in student or staff member has access to.
     */
    public function batches(Request $request)
    {
        $user = $request->user();

        if ($user instanceof Student) {
            if (!$user->batch_id) {
                return response()->json(['batches' => []]);
            }
            $batch = Batch::find($user->batch_id);
            return response()->json([
                'batches' => $batch ? [[
                    'id' => $batch->id,
                    'name' => $batch->name,
                    'schedule_time' => $batch->schedule_time,
                ]] : []
            ]);
        }

        // It is a User (staff)
        if ($user->isInstituteAdmin() || $user->isPrincipal()) {
            $batches = Batch::where('is_active', true)->get();
        } elseif ($user->isTeacher()) {
            $batches = Batch::where('class_teacher_id', $user->id)
                ->where('is_active', true)
                ->get();
        } else {
            return response()->json(['error' => 'Unauthorized access.'], 403);
        }

        return response()->json([
            'batches' => $batches->map(fn($b) => [
                'id' => $b->id,
                'name' => $b->name,
                'schedule_time' => $b->schedule_time,
            ])
        ]);
    }

    /**
     * Get messages for a particular batch chatroom.
     */
    public function messages(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
        ]);

        $batch = Batch::findOrFail($request->batch_id);
        $this->authorizeAccess($request->user(), $batch);

        $messages = ClassChatMessage::where('batch_id', $batch->id)
            ->orderBy('created_at', 'asc')
            ->limit(100)
            ->get()
            ->map(function ($msg) use ($request) {
                $senderName = 'Unknown';
                $senderAvatar = '';
                $senderRole = 'Student';

                if ($msg->sender) {
                    $senderName = $msg->sender->name;
                    $senderAvatar = $msg->sender->profile_image_url;

                    if ($msg->sender_type === User::class) {
                        $senderRole = $msg->sender->role->name ?? 'Staff';
                    }
                }

                $currentUser = $request->user();
                $isMe = ($msg->sender_id === $currentUser->id && $msg->sender_type === get_class($currentUser));

                return [
                    'id' => $msg->id,
                    'message' => $msg->message,
                    'sender_id' => $msg->sender_id,
                    'sender_name' => $senderName,
                    'sender_avatar' => $senderAvatar,
                    'sender_role' => $senderRole,
                    'is_me' => $isMe,
                    'time' => $msg->created_at->format('h:i A'),
                ];
            });

        return response()->json([
            'messages' => $messages,
        ]);
    }

    /**
     * Send message to a class chatroom.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'message' => 'required|string|max:1000',
        ]);

        $batch = Batch::findOrFail($request->batch_id);
        $currentUser = $request->user();

        $this->authorizeAccess($currentUser, $batch);

        $msg = ClassChatMessage::create([
            'institute_id' => $currentUser->institute_id,
            'batch_id' => $batch->id,
            'sender_type' => get_class($currentUser),
            'sender_id' => $currentUser->id,
            'message' => $request->message,
        ]);

        $senderRole = 'Student';
        if ($currentUser instanceof User) {
            $senderRole = $currentUser->role->name ?? 'Staff';
        }

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id,
                'message' => $msg->message,
                'sender_id' => $msg->sender_id,
                'sender_name' => $currentUser->name,
                'sender_avatar' => $currentUser->profile_image_url,
                'sender_role' => $senderRole,
                'is_me' => true,
                'time' => $msg->created_at->format('h:i A'),
            ]
        ]);
    }

    /**
     * Authorize user access to a batch's chat.
     */
    protected function authorizeAccess($user, Batch $batch)
    {
        if ($user instanceof Student) {
            if ($batch->id !== $user->batch_id) {
                abort(response()->json(['error' => 'Access denied.'], 403));
            }
            return;
        }

        // Staff auth
        if ($user->isInstituteAdmin() || $user->isPrincipal()) {
            return;
        }

        if ($user->isTeacher() && $batch->class_teacher_id === $user->id) {
            return;
        }

        abort(response()->json(['error' => 'Access denied.'], 403));
    }
}
