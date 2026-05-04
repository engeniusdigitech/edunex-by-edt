<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Return the last 50 messages for this institute.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        if (!$user || !$user->institute_id) {
            return response()->json(['messages' => []]);
        }

        $messages = ChatMessage::with('user')
            ->where('institute_id', $user->institute_id)
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get()
            ->reverse()
            ->values()
            ->map(function ($msg) use ($user) {
                return [
                    'id'         => $msg->id,
                    'message'    => $msg->message,
                    'user_id'    => $msg->user_id,
                    'user_name'  => $msg->user->name ?? 'Unknown',
                    'user_role'  => $msg->user->role->name ?? '',
                    'user_avatar'=> $msg->user->profile_image_url ?? '',
                    'is_me'      => $msg->user_id === $user->id,
                    'time'       => $msg->created_at->format('h:i A'),
                ];
            });

        // Also return all staff names for @mention
        $staffNames = User::where('institute_id', $user->institute_id)
            ->where('id', '!=', $user->id)
            ->with('role')
            ->get()
            ->map(fn($u) => ['id' => $u->id, 'name' => $u->name])
            ->values();

        return response()->json([
            'messages'   => $messages,
            'staff'      => $staffNames,
            'my_id'      => $user->id,
            'my_name'    => $user->name,
        ]);
    }

    /**
     * Store a new chat message.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user || !$user->institute_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $msg = ChatMessage::create([
            'institute_id' => $user->institute_id,
            'user_id'      => $user->id,
            'message'      => $request->message,
        ]);

        $msg->load('user');

        return response()->json([
            'id'         => $msg->id,
            'message'    => $msg->message,
            'user_id'    => $msg->user_id,
            'user_name'  => $msg->user->name,
            'user_role'  => $msg->user->role->name ?? '',
            'user_avatar'=> $msg->user->profile_image_url,
            'is_me'      => true,
            'time'       => $msg->created_at->format('h:i A'),
        ]);
    }
}
