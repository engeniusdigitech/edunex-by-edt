<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $announcements = collect();
        if (class_exists(\App\Models\Announcement::class)) {
            $announcements = \App\Models\Announcement::latest()->get()->map(fn($a) => [
                'id' => $a->id,
                'title' => $a->title,
                'body' => $a->body ?? $a->content ?? null,
                'date' => optional($a->created_at)->format('Y-m-d'),
            ])->values();
        }
        return response()->json(['announcements' => $announcements]);
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required|string', 'body' => 'required|string']);
        if (class_exists(\App\Models\Announcement::class)) {
            \App\Models\Announcement::create(array_merge($request->validated(), [
                'created_by' => $request->user()->id,
            ]));
        }
        return response()->json(['message' => 'Announcement created'], 201);
    }
}
