<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\User;
use App\Models\Role;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status', 'pending');
        $query = Visitor::with('whomToMeet');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('visitor_name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone_number', 'like', '%' . $request->search . '%')
                  ->orWhere('pass_number', 'like', '%' . $request->search . '%');
            });
        }

        $query->where('status', $status);
        $visitors = $query->latest()->paginate(15);

        // Counts for KPI & Tabs
        $pendingCount = Visitor::where('status', 'pending')->count();
        $activeCount = Visitor::where('status', 'checked_in')->count();
        $checkedOutCount = Visitor::where('status', 'checked_out')->count();
        $rejectedCount = Visitor::where('status', 'rejected')->count();
        
        $totalToday = Visitor::whereDate('created_at', Carbon::today())->count();

        return view('visitors.index', compact(
            'visitors', 
            'status',
            'pendingCount', 
            'activeCount', 
            'checkedOutCount', 
            'rejectedCount',
            'totalToday'
        ));
    }

    public function create()
    {
        $staffRoleIds = Role::whereIn('name', ['Principal', 'Teacher', 'Receptionist', 'Librarian', 'Staff'])->pluck('id');
        $staffMembers = User::whereIn('role_id', $staffRoleIds)->orderBy('name')->get();

        return view('visitors.create', compact('staffMembers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'visitor_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'purpose' => 'required|string|max:255',
            'whom_to_meet_id' => 'nullable|exists:users,id',
            'whom_to_meet_name' => 'nullable|string|max:255',
            'gate_number' => 'required|string|max:50',
            'vehicle_number' => 'nullable|string|max:50',
            'id_proof_type' => 'required|string|max:100',
            'id_proof_number' => 'nullable|string|max:100',
            'remarks' => 'nullable|string|max:500',
        ]);

        // Generate unique pass number: VIS-YYYYMMDD-XXXX
        $dateStr = Carbon::today()->format('Ymd');
        $todayCount = Visitor::whereDate('created_at', Carbon::today())->count();
        $sequence = str_pad($todayCount + 1, 4, '0', STR_PAD_LEFT);
        $passNumber = "VIS-{$dateStr}-{$sequence}";

        $visitor = Visitor::create([
            'institute_id' => Auth::user()->institute_id,
            'pass_number' => $passNumber,
            'visitor_name' => $request->visitor_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'purpose' => $request->purpose,
            'whom_to_meet_id' => $request->whom_to_meet_id,
            'whom_to_meet_name' => $request->whom_to_meet_name,
            'gate_number' => $request->gate_number,
            'vehicle_number' => $request->vehicle_number,
            'id_proof_type' => $request->id_proof_type,
            'id_proof_number' => $request->id_proof_number,
            'check_in_time' => Carbon::now(),
            'status' => 'checked_in',
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('visitors.pass', $visitor->id)
            ->with('success', 'Visitor checked in successfully. Print gate badge below.');
    }

    public function checkout(Visitor $visitor)
    {
        $visitor->update([
            'status' => 'checked_out',
            'check_out_time' => Carbon::now(),
        ]);

        return redirect()->route('visitors.index', ['status' => 'checked_out'])->with('success', "Visitor {$visitor->visitor_name} checked out successfully.");
    }

    public function pass(Visitor $visitor)
    {
        $visitor->load('whomToMeet');
        return view('visitors.pass', compact('visitor'));
    }

    // --- QR Public Self-Registration Flow ---

    public function publicRegisterForm(Institute $institute)
    {
        $staffRoleIds = Role::whereIn('name', ['Principal', 'Teacher', 'Receptionist', 'Librarian', 'Staff'])->pluck('id');
        $staffMembers = User::where('institute_id', $institute->id)
            ->whereIn('role_id', $staffRoleIds)
            ->orderBy('name')
            ->get();

        return view('visitors.public_register', compact('institute', 'staffMembers'));
    }

    public function publicRegisterStore(Request $request, Institute $institute)
    {
        $request->validate([
            'visitor_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'purpose' => 'required|string|max:255',
            'whom_to_meet_id' => 'nullable|exists:users,id',
            'whom_to_meet_name' => 'nullable|string|max:255',
            'gate_number' => 'required|string|max:50',
            'vehicle_number' => 'nullable|string|max:50',
            'id_proof_type' => 'required|string|max:100',
            'id_proof_number' => 'nullable|string|max:100',
            'remarks' => 'nullable|string|max:500',
        ]);

        // Generate unique pass number: VIS-YYYYMMDD-XXXX
        $dateStr = Carbon::today()->format('Ymd');
        $todayCount = Visitor::whereDate('created_at', Carbon::today())->count();
        $sequence = str_pad($todayCount + 1, 4, '0', STR_PAD_LEFT);
        $passNumber = "VIS-{$dateStr}-{$sequence}";

        $visitor = Visitor::create([
            'institute_id' => $institute->id,
            'pass_number' => $passNumber,
            'visitor_name' => $request->visitor_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'purpose' => $request->purpose,
            'whom_to_meet_id' => $request->whom_to_meet_id,
            'whom_to_meet_name' => $request->whom_to_meet_name,
            'gate_number' => $request->gate_number,
            'vehicle_number' => $request->vehicle_number,
            'id_proof_type' => $request->id_proof_type,
            'id_proof_number' => $request->id_proof_number,
            'check_in_time' => null, // null until approved
            'status' => 'pending',   // pending approval
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('visitors.public-status', $visitor->id);
    }

    public function publicRegisterStatus(Visitor $visitor)
    {
        $visitor->load('institute', 'whomToMeet');
        return view('visitors.public_status', compact('visitor'));
    }

    public function checkStatus(Visitor $visitor)
    {
        return response()->json([
            'status' => $visitor->status
        ]);
    }

    // --- Guards/Receptionist Decisions ---

    public function approve(Visitor $visitor)
    {
        $visitor->update([
            'status' => 'checked_in',
            'check_in_time' => Carbon::now(),
        ]);

        return redirect()->route('visitors.index', ['status' => 'checked_in'])
            ->with('success', "Visitor {$visitor->visitor_name} entry request approved.");
    }

    public function reject(Visitor $visitor)
    {
        $visitor->update([
            'status' => 'rejected',
        ]);

        return redirect()->route('visitors.index', ['status' => 'rejected'])
            ->with('success', "Visitor {$visitor->visitor_name} entry request rejected.");
    }
}
