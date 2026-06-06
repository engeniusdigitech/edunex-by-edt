<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\TransportRoute;
use App\Models\TransportStop;
use App\Models\VehicleTrip;
use App\Models\StudentBoardingLog;
use App\Models\StudentTransportAllocation;
use App\Notifications\CustomPortalNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransportTrackingController extends Controller
{
    public function index(Request $request)
    {
        $routes = TransportRoute::with(['stops' => function ($q) {
            $q->orderBy('sort_order');
        }])->get();
        
        $vehicles = Vehicle::where('is_active', true)->get();
        
        // Active trips running right now
        $activeTrips = VehicleTrip::where('status', 'en_route')
            ->with(['vehicle', 'route.stops' => function ($q) {
                $q->orderBy('sort_order');
            }, 'boardingLogs.student'])
            ->latest()
            ->get();

        $selectedTrip = null;
        if ($request->filled('trip_id')) {
            $selectedTrip = VehicleTrip::with(['vehicle', 'route.stops' => function ($q) {
                $q->orderBy('sort_order');
            }, 'boardingLogs.student'])->find($request->trip_id);
        } elseif ($activeTrips->count() > 0) {
            $selectedTrip = $activeTrips->first();
        }

        $allocatedStudents = collect();
        if ($selectedTrip) {
            $allocatedStudents = StudentTransportAllocation::where('transport_route_id', $selectedTrip->transport_route_id)
                ->with('student')
                ->get()
                ->map(function ($alloc) {
                    if ($alloc->student) {
                        $alloc->student->transport_stop_id = $alloc->transport_stop_id;
                    }
                    return $alloc->student;
                })->filter();
        }

        return view('transport.tracking', compact('routes', 'vehicles', 'activeTrips', 'selectedTrip', 'allocatedStudents'));
    }

    public function startTrip(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'transport_route_id' => 'required|exists:transport_routes,id',
        ]);

        // Verify if vehicle already in a running trip
        $active = VehicleTrip::where('vehicle_id', $request->vehicle_id)
            ->where('status', 'en_route')
            ->first();

        if ($active) {
            return back()->withErrors(['vehicle_id' => 'This vehicle is currently running another active trip.']);
        }

        // Get the first stop of the route for initial coordinates
        $firstStop = TransportStop::where('transport_route_id', $request->transport_route_id)
            ->orderBy('sort_order')
            ->first();

        $trip = VehicleTrip::create([
            'institute_id' => Auth::user()->institute_id,
            'vehicle_id' => $request->vehicle_id,
            'transport_route_id' => $request->transport_route_id,
            'status' => 'en_route',
            'current_lat' => $firstStop ? $firstStop->latitude : 28.6139,
            'current_lng' => $firstStop ? $firstStop->longitude : 77.2090,
            'started_at' => Carbon::now(),
        ]);

        return redirect()->route('transport.tracking.index', ['trip_id' => $trip->id])
            ->with('success', 'Vehicle trip started successfully. Live simulation online.');
    }

    public function updateLocation(Request $request, VehicleTrip $trip)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $trip->update([
            'current_lat' => $request->latitude,
            'current_lng' => $request->longitude,
        ]);

        return response()->json(['success' => true]);
    }

    public function boardStudent(Request $request, VehicleTrip $trip)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'transport_stop_id' => 'required|exists:transport_stops,id',
            'direction' => 'required|in:pickup,dropoff',
            'status' => 'required|in:boarded,deboarded,absent',
        ]);

        // Check if log already exists for this trip & student
        $log = StudentBoardingLog::updateOrCreate(
            [
                'vehicle_trip_id' => $trip->id,
                'student_id' => $request->student_id,
                'transport_stop_id' => $request->transport_stop_id,
            ],
            [
                'institute_id' => Auth::user()->institute_id,
                'direction' => $request->direction,
                'status' => $request->status,
                'logged_at' => Carbon::now(),
            ]
        );

        // Notify Student
        $student = \App\Models\Student::find($request->student_id);
        $stop = \App\Models\TransportStop::find($request->transport_stop_id);
        $verb = $request->status === 'boarded' ? 'boarded' : ($request->status === 'deboarded' ? 'deboarded from' : 'missed');
        
        $title = "Transport Alert";
        $message = "You have been marked as {$verb} the bus at stop: {$stop->stop_name}.";
        
        $notification = new CustomPortalNotification(
            $title,
            $message,
            'fas fa-bus',
            $request->status === 'boarded' ? 'success' : ($request->status === 'deboarded' ? 'primary' : 'danger')
        );
        $student->notify($notification);

        return response()->json([
            'success' => true,
            'log' => $log->load('student')
        ]);
    }

    public function completeTrip(Request $request, VehicleTrip $trip)
    {
        $trip->update([
            'status' => 'completed',
            'completed_at' => Carbon::now(),
        ]);

        return redirect()->route('transport.tracking.index')->with('success', 'Trip completed successfully.');
    }

    public function optimizeRoute(Request $request, TransportRoute $route)
    {
        $stops = TransportStop::where('transport_route_id', $route->id)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        if ($stops->count() <= 1) {
            return back()->withErrors(['error' => 'At least 2 stops with coordinates are required to optimize the route.']);
        }

        // Greedy TSP starting from institute hub (Delhi default: 28.6139, 77.2090)
        $startLat = 28.6139;
        $startLng = 77.2090;

        $unvisited = $stops->all();
        $ordered = [];
        $currentLat = $startLat;
        $currentLng = $startLng;

        while (count($unvisited) > 0) {
            $nearestIdx = 0;
            $minDistance = INF;

            foreach ($unvisited as $idx => $stop) {
                // Approximate Euclidean distance
                $dist = sqrt(pow($stop->latitude - $currentLat, 2) + pow($stop->longitude - $currentLng, 2));
                if ($dist < $minDistance) {
                    $minDistance = $dist;
                    $nearestIdx = $idx;
                }
            }

            $nearestStop = $unvisited[$nearestIdx];
            $ordered[] = $nearestStop;
            $currentLat = $nearestStop->latitude;
            $currentLng = $nearestStop->longitude;

            // Remove from unvisited array
            array_splice($unvisited, $nearestIdx, 1);
        }

        // Save optimized order
        foreach ($ordered as $order => $stop) {
            $stop->update(['sort_order' => $order + 1]);
        }

        return redirect()->route('transport.tracking.index')->with('success', 'Route stops optimized geographically using nearest-neighbor route algorithm.');
    }
}
