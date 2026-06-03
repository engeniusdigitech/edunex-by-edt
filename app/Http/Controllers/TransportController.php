<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\TransportRoute;
use App\Models\TransportStop;
use App\Models\Driver;
use App\Models\Student;
use App\Models\StudentTransportAllocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportController extends Controller
{
    /**
     * Transport Dashboard
     */
    public function dashboard()
    {
        $totalVehicles = Vehicle::count();
        $totalRoutes = TransportRoute::count();
        $totalDrivers = Driver::count();
        $totalStudents = StudentTransportAllocation::count();

        // Recent allocations
        $recentAllocations = StudentTransportAllocation::with(['student', 'route', 'stop', 'vehicle'])
            ->latest()
            ->limit(5)
            ->get();

        return view('transport.dashboard', compact(
            'totalVehicles',
            'totalRoutes',
            'totalDrivers',
            'totalStudents',
            'recentAllocations'
        ));
    }

    /**
     * ── VEHICLES CRUD ──
     */
    public function vehicles()
    {
        $vehicles = Vehicle::all();
        return view('transport.vehicles', compact('vehicles'));
    }

    public function storeVehicle(Request $request)
    {
        $request->validate([
            'vehicle_number' => 'required|string|max:50',
            'vehicle_name' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        Vehicle::create([
            'institute_id' => Auth::user()->institute_id,
            'vehicle_number' => $request->vehicle_number,
            'vehicle_name' => $request->vehicle_name,
            'capacity' => $request->capacity,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('transport.vehicles')->with('success', 'Vehicle added successfully.');
    }

    public function updateVehicle(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'vehicle_number' => 'required|string|max:50',
            'vehicle_name' => 'required|string|max:100',
            'capacity' => 'required|integer|min:1',
            'is_active' => 'required|boolean',
        ]);

        $vehicle->update($request->only('vehicle_number', 'vehicle_name', 'capacity', 'is_active'));

        return redirect()->route('transport.vehicles')->with('success', 'Vehicle updated successfully.');
    }

    public function deleteVehicle(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('transport.vehicles')->with('success', 'Vehicle deleted successfully.');
    }

    /**
     * ── ROUTES CRUD ──
     */
    public function routes()
    {
        $routes = TransportRoute::withCount('stops')->get();
        return view('transport.routes', compact('routes'));
    }

    public function storeRoute(Request $request)
    {
        $request->validate([
            'route_name' => 'required|string|max:100',
            'route_description' => 'nullable|string|max:500',
            'fee' => 'required|numeric|min:0',
        ]);

        TransportRoute::create([
            'institute_id' => Auth::user()->institute_id,
            'route_name' => $request->route_name,
            'route_description' => $request->route_description,
            'fee' => $request->fee,
        ]);

        return redirect()->route('transport.routes')->with('success', 'Route added successfully.');
    }

    public function updateRoute(Request $request, TransportRoute $route)
    {
        $request->validate([
            'route_name' => 'required|string|max:100',
            'route_description' => 'nullable|string|max:500',
            'fee' => 'required|numeric|min:0',
        ]);

        $route->update($request->only('route_name', 'route_description', 'fee'));

        return redirect()->route('transport.routes')->with('success', 'Route updated successfully.');
    }

    public function deleteRoute(TransportRoute $route)
    {
        $route->delete();
        return redirect()->route('transport.routes')->with('success', 'Route deleted successfully.');
    }

    /**
     * ── STOPS CRUD ──
     */
    public function stops()
    {
        $stops = TransportStop::with('route')->get();
        $routes = TransportRoute::all();
        return view('transport.stops', compact('stops', 'routes'));
    }

    public function storeStop(Request $request)
    {
        $request->validate([
            'stop_name' => 'required|string|max:100',
            'transport_route_id' => 'required|exists:transport_routes,id',
        ]);

        TransportStop::create([
            'institute_id' => Auth::user()->institute_id,
            'stop_name' => $request->stop_name,
            'transport_route_id' => $request->transport_route_id,
        ]);

        return redirect()->route('transport.stops')->with('success', 'Stop added successfully.');
    }

    public function updateStop(Request $request, TransportStop $stop)
    {
        $request->validate([
            'stop_name' => 'required|string|max:100',
            'transport_route_id' => 'required|exists:transport_routes,id',
        ]);

        $stop->update($request->only('stop_name', 'transport_route_id'));

        return redirect()->route('transport.stops')->with('success', 'Stop updated successfully.');
    }

    public function deleteStop(TransportStop $stop)
    {
        $stop->delete();
        return redirect()->route('transport.stops')->with('success', 'Stop deleted successfully.');
    }

    /**
     * ── DRIVERS CRUD ──
     */
    public function drivers()
    {
        $drivers = Driver::with('vehicle')->get();
        $vehicles = Vehicle::where('is_active', true)->get();
        return view('transport.drivers', compact('drivers', 'vehicles'));
    }

    public function storeDriver(Request $request)
    {
        $request->validate([
            'driver_name' => 'required|string|max:100',
            'mobile_number' => 'required|string|max:20',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        Driver::create([
            'institute_id' => Auth::user()->institute_id,
            'driver_name' => $request->driver_name,
            'mobile_number' => $request->mobile_number,
            'vehicle_id' => $request->vehicle_id,
        ]);

        return redirect()->route('transport.drivers')->with('success', 'Driver added successfully.');
    }

    public function updateDriver(Request $request, Driver $driver)
    {
        $request->validate([
            'driver_name' => 'required|string|max:100',
            'mobile_number' => 'required|string|max:20',
            'vehicle_id' => 'nullable|exists:vehicles,id',
        ]);

        $driver->update($request->only('driver_name', 'mobile_number', 'vehicle_id'));

        return redirect()->route('transport.drivers')->with('success', 'Driver updated successfully.');
    }

    public function deleteDriver(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('transport.drivers')->with('success', 'Driver deleted successfully.');
    }

    /**
     * ── ALLOCATIONS CRUD ──
     */
    public function allocations()
    {
        $allocations = StudentTransportAllocation::with(['student', 'route', 'stop', 'vehicle'])->get();
        $students = Student::where('is_active', true)->get();
        $routes = TransportRoute::all();
        $stops = TransportStop::all();
        $vehicles = Vehicle::where('is_active', true)->get();
        
        return view('transport.allocations', compact('allocations', 'students', 'routes', 'stops', 'vehicles'));
    }

    public function storeAllocation(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id|unique:student_transport_allocations,student_id',
            'transport_route_id' => 'required|exists:transport_routes,id',
            'transport_stop_id' => 'required|exists:transport_stops,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'fee_status' => 'required|in:Paid,Pending',
        ]);

        StudentTransportAllocation::create([
            'institute_id' => Auth::user()->institute_id,
            'student_id' => $request->student_id,
            'transport_route_id' => $request->transport_route_id,
            'transport_stop_id' => $request->transport_stop_id,
            'vehicle_id' => $request->vehicle_id,
            'fee_status' => $request->fee_status,
        ]);

        return redirect()->route('transport.allocations')->with('success', 'Student transport allocated successfully.');
    }

    public function updateAllocation(Request $request, StudentTransportAllocation $allocation)
    {
        $request->validate([
            'transport_route_id' => 'required|exists:transport_routes,id',
            'transport_stop_id' => 'required|exists:transport_stops,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'fee_status' => 'required|in:Paid,Pending',
        ]);

        $allocation->update($request->only('transport_route_id', 'transport_stop_id', 'vehicle_id', 'fee_status'));

        return redirect()->route('transport.allocations')->with('success', 'Allocation updated successfully.');
    }

    public function deleteAllocation(StudentTransportAllocation $allocation)
    {
        $allocation->delete();
        return redirect()->route('transport.allocations')->with('success', 'Allocation removed successfully.');
    }

    /**
     * ── REPORTS ──
     */
    public function reports(Request $request)
    {
        $routes = TransportRoute::all();
        $vehicles = Vehicle::all();

        $selectedRouteId = $request->get('route_id');
        $selectedVehicleId = $request->get('vehicle_id');

        $routeStudents = [];
        if ($selectedRouteId) {
            $routeStudents = StudentTransportAllocation::with(['student', 'stop', 'vehicle'])
                ->where('transport_route_id', $selectedRouteId)
                ->get();
        }

        $vehicleStudents = [];
        if ($selectedVehicleId) {
            $vehicleStudents = StudentTransportAllocation::with(['student', 'route', 'stop'])
                ->where('vehicle_id', $selectedVehicleId)
                ->get();
        }

        // Pending Fees report
        $pendingFeesList = StudentTransportAllocation::with(['student', 'route', 'stop', 'vehicle'])
            ->where('fee_status', 'Pending')
            ->get();

        return view('transport.reports', compact(
            'routes',
            'vehicles',
            'selectedRouteId',
            'selectedVehicleId',
            'routeStudents',
            'vehicleStudents',
            'pendingFeesList'
        ));
    }
}
