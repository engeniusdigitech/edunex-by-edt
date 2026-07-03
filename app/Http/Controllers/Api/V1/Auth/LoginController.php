<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Normalize DB role names → Flutter slug constants.
     * Flutter AppConstants expects: student, parent, admin, principal,
     * class_teacher, subject_teacher, librarian, receptionist, hostel_warden.
     */
    private function normalizeRole(string $roleName): string
    {
        return match (strtolower(trim($roleName))) {
            'student'                       => 'student',
            'parent', 'guardian'            => 'parent',
            'super admin', 'superadmin',
            'institute admin', 'admin'      => 'admin',
            'principal', 'vice principal'   => 'principal',
            'class teacher', 'classteacher',
            'teacher', 'staff'              => 'class_teacher',
            'subject teacher'               => 'subject_teacher',
            'librarian'                     => 'librarian',
            'receptionist', 'front desk'    => 'receptionist',
            'warden', 'hostel warden',
            'hostelwarden'                  => 'hostel_warden',
            default                         => strtolower(str_replace(' ', '_', $roleName)),
        };
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'       => 'required|email',
            'password'    => 'required',
            'device_name' => 'required',
        ]);

        // ── Student login ────────────────────────────────────────────────────
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
                'token'     => $student->createToken($request->device_name)->plainTextToken,
                'user_type' => 'student',
                'user'      => [
                    'id'                 => $student->id,
                    'name'               => $student->name,
                    'email'              => $student->email,
                    'role'               => 'student',
                    'roll_number'        => $student->roll_number,
                    'admission_no'       => $student->admission_no ?? null,
                    'profile_image_url'  => $student->profile_image
                                            ? asset('storage/' . $student->profile_image)
                                            : null,
                    'institute_id'       => $student->institute_id,
                ],
            ]);
        }

        // ── Staff / User login ───────────────────────────────────────────────
        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user) {
            if (!Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['The provided credentials are incorrect.'],
                ]);
            }

            $roleName      = $user->role?->name ?? 'staff';
            $normalizedRole = $this->normalizeRole($roleName);

            return response()->json([
                'token'     => $user->createToken($request->device_name)->plainTextToken,
                'user_type' => 'staff',
                'user'      => [
                    'id'                => $user->id,
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'role'              => $normalizedRole,
                    'profile_image_url' => $user->profile_image
                                          ? asset('storage/' . $user->profile_image)
                                          : null,
                    'institute_id'      => $user->institute_id,
                ],
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
