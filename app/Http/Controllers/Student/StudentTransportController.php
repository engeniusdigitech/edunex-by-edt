<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentTransportAllocation;
use Illuminate\Support\Facades\Auth;

class StudentTransportController extends Controller
{
    /**
     * Display the transport allocation details for the logged-in student.
     */
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Retrieve student transport allocation, route, stop, vehicle, and driver
        $allocation = StudentTransportAllocation::with(['route', 'stop', 'vehicle.drivers'])
            ->where('student_id', $student->id)
            ->first();

        return view('student.transport.index', compact('allocation'));
    }
}
