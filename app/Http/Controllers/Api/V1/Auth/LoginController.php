<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $student = Student::where('email', $request->email)->first();

        if ($student) {
            if (!Hash::check($request->password, $student->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            if (!$student->is_active) {
                return response()->json([
                    'message' => 'Your account is deactivated. Please contact admin.'
                ], 403);
            }

            return response()->json([
                'token' => $student->createToken($request->device_name)->plainTextToken,
                'user_type' => 'student',
                'student' => [
                    'name' => $student->name,
                    'email' => $student->email,
                    'institute_id' => $student->institute_id,
                ]
            ]);
        }

        // Try authenticating as Staff User
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            return response()->json([
                'token' => $user->createToken($request->device_name)->plainTextToken,
                'user_type' => 'staff',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role->name ?? 'Staff',
                    'institute_id' => $user->institute_id,
                ]
            ]);
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
