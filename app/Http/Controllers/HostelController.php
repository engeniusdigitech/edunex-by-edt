<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\HostelRoom;
use App\Models\HostelAllocation;
use App\Models\HostelBill;
use App\Models\HostelMess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HostelController extends Controller
{
    public function dashboard()
    {
        $totalHostels = Hostel::count();
        $totalRooms = HostelRoom::count();
        $totalCapacity = (int) HostelRoom::sum('capacity');
        $occupiedBeds = HostelAllocation::where('status', 'active')->count();
        $vacantBeds = max(0, $totalCapacity - $occupiedBeds);
        $occupancyPct = $totalCapacity > 0 ? round(($occupiedBeds / $totalCapacity) * 100, 1) : 0;

        $revenueCollected = (float) HostelBill::sum('paid_amount');
        $revenuePending = (float) HostelBill::sum('due_amount');

        $currentMonthBills = HostelBill::whereMonth('billing_month', Carbon::now()->month)
            ->whereYear('billing_month', Carbon::now()->year)
            ->get();
        $currentMonthCollected = (float) $currentMonthBills->sum('paid_amount');
        $currentMonthPending = (float) $currentMonthBills->sum('due_amount');

        $totalMesses = HostelMess::count();

        $hostelsBreakdown = Hostel::withCount('rooms')
            ->with(['rooms' => function ($q) {
                $q->withCount(['allocations' => function ($q2) {
                    $q2->where('status', 'active');
                }]);
            }])
            ->get()
            ->map(function ($hostel) {
                $capacity = $hostel->rooms->sum('capacity');
                $occupied = $hostel->rooms->sum('allocations_count');
                return [
                    'name' => $hostel->name,
                    'type' => $hostel->type,
                    'rooms_count' => $hostel->rooms_count,
                    'capacity' => $capacity,
                    'occupied' => $occupied,
                    'occupancy_pct' => $capacity > 0 ? round(($occupied / $capacity) * 100, 1) : 0,
                ];
            });

        $recentBills = HostelBill::with('student')->latest()->limit(8)->get();

        return view('hostels.dashboard', compact(
            'totalHostels',
            'totalRooms',
            'totalCapacity',
            'occupiedBeds',
            'vacantBeds',
            'occupancyPct',
            'revenueCollected',
            'revenuePending',
            'currentMonthCollected',
            'currentMonthPending',
            'totalMesses',
            'hostelsBreakdown',
            'recentBills'
        ));
    }

    public function index(Request $request)
    {
        $query = Hostel::withCount('rooms');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $hostels = $query->latest()->paginate(10);
        return view('hostels.index', compact('hostels'));
    }

    public function create()
    {
        return view('hostels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:boys,girls,mixed',
            'address'     => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        Hostel::create($validated);

        return redirect()->route('hostels.index')->with('success', 'Hostel block created successfully.');
    }

    public function show(Hostel $hostel)
    {
        $hostel->load('rooms.allocations.student');
        return view('hostels.rooms', compact('hostel'));
    }

    public function edit(Hostel $hostel)
    {
        return view('hostels.edit', compact('hostel'));
    }

    public function update(Request $request, Hostel $hostel)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:boys,girls,mixed',
            'address'     => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $hostel->update($validated);

        return redirect()->route('hostels.index')->with('success', 'Hostel block updated successfully.');
    }

    public function destroy(Hostel $hostel)
    {
        $hostel->delete();
        return redirect()->route('hostels.index')->with('success', 'Hostel block deleted successfully.');
    }

    public function storeRoom(Request $request, Hostel $hostel)
    {
        $validated = $request->validate([
            'room_number'    => 'required|string|max:50',
            'room_type'      => 'required|string|max:100',
            'capacity'       => 'required|integer|min:1|max:20',
            'cost_per_month' => 'required|numeric|min:0',
        ]);

        $hostel->rooms()->create($validated);

        return redirect()->route('hostels.show', $hostel)->with('success', 'Room added successfully.');
    }

    public function destroyRoom(Hostel $hostel, HostelRoom $room)
    {
        $room->delete();
        return redirect()->route('hostels.show', $hostel)->with('success', 'Room deleted successfully.');
    }
}
