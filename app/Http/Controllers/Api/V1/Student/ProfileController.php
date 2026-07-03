<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $student = $request->user();

        return response()->json([
            'id' => $student->id,
            'name' => $student->name,
            'email' => $student->email,
            'phone' => $student->phone,
            'roll_number' => $student->roll_number,
            'gender' => $student->gender,
            'blood_group' => $student->blood_group,
            'alternate_phone_1' => $student->alternate_phone_1,
            'alternate_phone_2' => $student->alternate_phone_2,
            'parent_email' => $student->parent_email,
            'father_name' => $student->father_name,
            'mother_name' => $student->mother_name,
            'enrollment_date' => $student->enrollment_date ? $student->enrollment_date->format('Y-m-d') : null,
            'profile_image_url' => $student->profile_image_url,
            'institute' => $student->institute ? [
                'name' => $student->institute->name,
                'logo' => $student->institute->logo,
            ] : null,
            'batch' => $student->batch ? [
                'name' => $student->batch->name,
            ] : null,
        ]);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $student = $request->user();

        if (!Hash::check($request->current_password, $student->password)) {
            return response()->json(['message' => 'Current password is incorrect.'], 422);
        }

        $student->update(['password' => Hash::make($request->password)]);

        return response()->json(['message' => 'Password changed successfully.']);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate(['photo' => 'required|image|max:2048']);
        $student = $request->user();

        $path = $request->file('photo')->store('profile-photos', 'public');
        $url = Storage::url($path);

        $student->update(['profile_image_url' => $url]);

        return response()->json(['profile_image_url' => $url, 'message' => 'Profile photo updated']);
    }
}
