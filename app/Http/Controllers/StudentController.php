<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Batch;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * Note: institute_id is automatically handled by the TenantScope
     */
    public function index()
    {
        $students = Student::with('batch')->latest()->paginate(15);

        return view('students.index', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'required|string|max:20',
            'batch_id' => 'required|exists:batches,id',
            'enrollment_date' => 'required|date',
        ]);

        // institute_id is auto-assigned via BelongsToInstitute trait on create
        Student::create($validated);

        // Activity log can be created here (or via Observers)

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }
}
