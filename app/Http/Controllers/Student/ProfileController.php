<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $student = auth('student')->user();
        return view('student.profile', compact('student'));
    }

    public function update(Request $request)
    {
        return back()->with('error', 'Profile editing is disabled for students. Please contact administration for changes.');
        
        $student = auth('student')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'phone']);

        if ($request->hasFile('profile_image')) {
            // Delete old image
            if ($student->profile_image) {
                Storage::disk('public')->delete($student->profile_image);
            }
            $data['profile_image'] = $request->file('profile_image')->store('student_profiles', 'public');
        }

        $student->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }
}
