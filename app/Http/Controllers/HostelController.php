<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\HostelRoom;
use Illuminate\Http\Request;

class HostelController extends Controller
{
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
