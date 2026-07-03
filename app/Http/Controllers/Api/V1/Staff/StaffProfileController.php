<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaffProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'staff' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'phone' => $user->phone ?? null,
                'designation' => $user->designation ?? $user->role,
                'profile_image_url' => $user->profile_photo_url ?? null,
                'joined_date' => optional($user->created_at)->format('Y-m-d'),
                'department' => $user->department ?? null,
            ],
        ]);
    }
}
