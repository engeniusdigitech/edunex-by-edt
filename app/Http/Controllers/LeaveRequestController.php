<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $query = LeaveRequest::whereNull('student_id')->with(['user', 'user.role']);

        // Admins and Principals see all staff leave requests
        if ($user->isInstituteAdmin() || $user->isPrincipal() || $user->isSuperAdmin()) {
            $query->where('institute_id', $user->institute_id);
        } else {
            // Regular staff only see their own requests
            $query->where('user_id', $user->id);
        }

        $leaves = $query->latest()->paginate(15);

        return view('leaves.index', compact('leaves'));
    }

    /**
     * Display a listing of student leave requests for authorized personnel.
     */
    public function studentLeaves()
    {
        $user = auth()->user();

        // Check if user is authorized to manage ANY student leaves
        if (!$user->isInstituteAdmin() && !$user->isPrincipal() && !$user->isClassTeacher()) {
            abort(403, 'Unauthorized action.');
        }

        $query = LeaveRequest::where('institute_id', $user->institute_id)
            ->whereNotNull('student_id')
            ->with(['student', 'student.batch']);

        // Principals and Institute Admins see ALL student leaves in the institute
        if ($user->isInstituteAdmin() || $user->isPrincipal()) {
            // No additional filtering needed outside of institute_id
        } 
        // Class Teachers only see leaves for students in their assigned batches
        elseif ($user->isClassTeacher()) {
            $batchIds = $user->managedBatches()->pluck('id');
            $query->whereHas('student', function($q) use ($batchIds) {
                $q->whereIn('batch_id', $batchIds);
            });
        }

        $leaves = $query->latest()->paginate(20);

        return view('leaves.students', compact('leaves'));
    }

    public function create()
    {
        return view('leaves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
        ]);

        LeaveRequest::create([
            'institute_id' => auth()->user()->institute_id,
            'user_id' => auth()->id(),
            'type' => $request->type,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('leaves.index')->with('success', 'Leave request submitted successfully.');
    }

    public function update(Request $request, $id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $this->authorizeReview($leave);

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'nullable|string',
        ]);

        $leave->update([
            'status' => $request->status,
            'reviewed_by' => auth()->id(),
            'rejection_reason' => $request->rejection_reason,
            'status_updated_at' => now(),
        ]);

        return back()->with('success', 'Leave request updated successfully.');
    }

    /**
     * Revert a leave request (Withdraw by applicant or Undo by reviewer).
     */
    public function revert($id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $user = auth()->user();

        // Scenario 1: Applicant withdrawing their own pending request (6h limit)
        $isApplicant = ($leave->user_id === $user->id) || ($leave->student_id && $user->id && $leave->student_id === $user->id);
        
        if ($leave->status === 'pending' && $isApplicant) {
            if ($leave->canBeWithdrawnByApplicant()) {
                $leave->delete();
                return back()->with('success', 'Leave request withdrawn successfully.');
            }
            return back()->with('error', 'Withdrawal period (6 hours) has expired.');
        }

        // Scenario 2: Reviewer undoing an approved/rejected decision (24h limit)
        if ($leave->status !== 'pending') {
            $this->authorizeReview($leave);
            if ($leave->canBeRevertedByReviewer()) {
                $leave->update([
                    'status' => 'pending',
                    'status_updated_at' => null,
                    'reviewed_by' => null,
                    'rejection_reason' => null,
                ]);
                return back()->with('success', 'Decision reverted to pending successfully.');
            }
            return back()->with('error', 'Reversion period (24 hours) has expired.');
        }

        abort(403, 'Unauthorized action.');
    }

    protected function authorizeReview(LeaveRequest $leave)
    {
        $user = auth()->user();

        if ($user->isInstituteAdmin()) return true;

        if ($user->isPrincipal()) {
            // Principal can approve Teachers, Receptionists, and Students
            if ($leave->student_id) return true;
            if ($leave->user && $leave->user->isStaff() && !$leave->user->isPrincipal()) return true;
        }

        // Teachers can approve their batch students
        if ($user->isTeacher() && $leave->student_id) {
            $student = Student::find($leave->student_id);
            if ($student && $student->batch && $student->batch->class_teacher_id == $user->id) {
                return true;
            }
        }

        abort(403, 'Unauthorized action.');
    }
}
