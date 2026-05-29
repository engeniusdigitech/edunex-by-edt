<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * Note: institute_id is automatically handled by the TenantScope
     */
    public function index(Request $request)
    {
        $query = Student::with('batch');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }

        $students = $query->latest()->paginate(15);
        $batches = Batch::all();

        return view('students.index', compact('students', 'batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $batches = Batch::where('is_active', true)->get();
        return view('students.create', compact('batches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:students,email',
            'phone' => 'required|string|max:20',
            'blood_group' => 'nullable|string|max:5',
            'alternate_phone_1' => 'nullable|string|max:20',
            'alternate_phone_2' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'batch_id' => 'required|exists:batches,id',
            'enrollment_date' => 'required|date',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('profile_image')) {
            $validated['profile_image'] = $request->file('profile_image')->store('students', 'public');
        }

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $batches = Batch::where('is_active', true)->get();
        return view('students.edit', compact('student', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:students,email,' . $student->id,
            'phone' => 'required|string|max:20',
            'blood_group' => 'nullable|string|max:5',
            'alternate_phone_1' => 'nullable|string|max:20',
            'alternate_phone_2' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'batch_id' => 'required|exists:batches,id',
            'enrollment_date' => 'required|date',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048',
        ];

        $validated = $request->validate($rules);

        if ($request->hasFile('profile_image')) {
            if ($student->profile_image) {
                \Storage::disk('public')->delete($student->profile_image);
            }
            $validated['profile_image'] = $request->file('profile_image')->store('students', 'public');
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }
        else {
            unset($validated['password']);
        }

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
