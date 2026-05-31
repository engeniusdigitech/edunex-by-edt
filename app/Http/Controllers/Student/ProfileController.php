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
        $student = auth('student')->user();
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $student->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $student->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
