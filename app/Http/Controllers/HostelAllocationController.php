<?php

namespace App\Http\Controllers;

use App\Models\HostelAllocation;
use App\Models\HostelRoom;
use App\Models\Student;
use App\Models\HostelBill;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HostelAllocationController extends Controller
{
    public function index(Request $request)
    {
        $query = HostelAllocation::with(['student', 'room.hostel']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $allocations = $query->latest()->paginate(15);
        return view('hostel-allocations.index', compact('allocations'));
    }

    public function create()
    {
        // Get active students who don't have active room allocations
        $allocatedStudentIds = HostelAllocation::where('status', 'active')->pluck('student_id');
        $students = Student::whereNotIn('id', $allocatedStudentIds)->get();

        // Get rooms with available capacity
        $rooms = HostelRoom::with('hostel')->get()->filter(function ($room) {
            return $room->available_beds > 0;
        });

        return view('hostel-allocations.create', compact('students', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id'     => 'required|exists:students,id',
            'hostel_room_id' => 'required|exists:hostel_rooms,id',
            'allocated_from' => 'required|date',
        ]);

        $room = HostelRoom::findOrFail($validated['hostel_room_id']);
        if ($room->available_beds <= 0) {
            return back()->withErrors(['hostel_room_id' => 'This room has no available capacity.']);
        }

        // Check if student already has active allocation
        $existing = HostelAllocation::where('student_id', $validated['student_id'])
            ->where('status', 'active')
            ->first();

        if ($existing) {
            return back()->withErrors(['student_id' => 'This student already has an active room allocation.']);
        }

        $validated['status'] = 'active';
        HostelAllocation::create($validated);

        return redirect()->route('hostel-allocations.index')->with('success', 'Room allocated successfully.');
    }

    public function checkout(HostelAllocation $allocation)
    {
        $allocation->update([
            'status'       => 'completed',
            'allocated_to' => Carbon::today(),
        ]);

        return redirect()->route('hostel-allocations.index')->with('success', 'Student checked out successfully.');
    }

    public function generateBills(Request $request)
    {
        $request->validate([
            'billing_month' => 'required|date_format:Y-m',
        ]);

        $monthString = $request->billing_month . '-01';
        $billingMonth = Carbon::parse($monthString);

        // Fetch active allocations
        $allocations = HostelAllocation::where('status', 'active')->with(['student', 'room'])->get();

        $generatedCount = 0;
        foreach ($allocations as $alloc) {
            // Check if bill already generated for this month
            $exists = HostelBill::where('student_id', $alloc->student_id)
                ->whereYear('billing_month', $billingMonth->year)
                ->whereMonth('billing_month', $billingMonth->month)
                ->exists();

            if ($exists) continue;

            $amount = $alloc->room->cost_per_month;

            HostelBill::create([
                'student_id'    => $alloc->student_id,
                'amount'        => $amount,
                'due_amount'    => $amount,
                'billing_month' => $monthString,
                'status'        => 'unpaid',
                'description'   => "Room {$alloc->room->room_number} rent for " . $billingMonth->format('F Y'),
            ]);

            $generatedCount++;
        }

        return redirect()->route('hostel-bills.index')
            ->with('success', "Hostel bills generated successfully for {$generatedCount} student(s).");
    }
}
