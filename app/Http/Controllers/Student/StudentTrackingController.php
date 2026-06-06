<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentTransportAllocation;
use App\Models\VehicleTrip;
use App\Models\StudentBoardingLog;
use Illuminate\Support\Facades\Auth;

class StudentTrackingController extends Controller
{
    public function tracking()
    {
        $student = Auth::guard('student')->user();

        // Get student transport allocation
        $allocation = StudentTransportAllocation::where('student_id', $student->id)
            ->with(['route.stops' => function ($q) {
                $q->orderBy('sort_order');
            }, 'stop', 'vehicle.drivers'])
            ->first();

        $activeTrip = null;
        $boardingLogs = collect();

        if ($allocation) {
            // Find active trip running on their allocated route
            $activeTrip = VehicleTrip::where('transport_route_id', $allocation->transport_route_id)
                ->where('status', 'en_route')
                ->first();

            // Boarding logs history
            $boardingLogs = StudentBoardingLog::where('student_id', $student->id)
                ->with(['stop', 'trip.vehicle'])
                ->latest()
                ->get();
        }

        if (request()->ajax()) {
            return response()->json([
                'activeTrip' => $activeTrip
            ]);
        }

        return view('student.transport.tracking', compact('allocation', 'activeTrip', 'boardingLogs'));
    }
}
