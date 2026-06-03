<?php

namespace App\Http\Controllers\Api\V1\Transport;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentTransportAllocation;
use Illuminate\Http\Request;

class TransportApiController extends Controller
{
    /**
     * Fetch transport details for the logged-in student.
     */
    public function studentTransport(Request $request)
    {
        $user = $request->user();

        if (!$user instanceof Student) {
            return response()->json(['error' => 'This endpoint is only accessible to students.'], 403);
        }

        $allocation = StudentTransportAllocation::with(['route', 'stop', 'vehicle.drivers'])
            ->where('student_id', $user->id)
            ->first();

        if (!$allocation) {
            return response()->json([
                'allocated' => false,
                'message' => 'No transport has been allocated to you yet.',
            ]);
        }

        $driver = $allocation->vehicle->drivers->first();

        return response()->json([
            'allocated' => true,
            'route' => [
                'id' => $allocation->route->id,
                'name' => $allocation->route->route_name,
                'description' => $allocation->route->route_description,
                'fee' => $allocation->route->fee,
            ],
            'stop' => [
                'id' => $allocation->stop->id,
                'name' => $allocation->stop->stop_name,
            ],
            'vehicle' => [
                'id' => $allocation->vehicle->id,
                'name' => $allocation->vehicle->vehicle_name,
                'number' => $allocation->vehicle->vehicle_number,
            ],
            'driver' => $driver ? [
                'name' => $driver->driver_name,
                'phone' => $driver->mobile_number,
            ] : null,
            'fee_status' => $allocation->fee_status,
        ]);
    }
}
