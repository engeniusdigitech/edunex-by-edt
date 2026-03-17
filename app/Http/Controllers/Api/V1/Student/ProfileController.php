<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'enrollment_date' => $student->enrollment_date,
            'institute' => $student->institute ? [
                'name' => $student->institute->name,
                'logo' => $student->institute->logo,
            ] : null,
            'batch' => $student->batch ? [
                'name' => $student->batch->name,
            ] : null,
        ]);
    }
}
