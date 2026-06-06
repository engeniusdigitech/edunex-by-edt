<?php

namespace App\Http\Controllers;

use App\Models\HostelMess;
use App\Models\MessMenu;
use App\Models\StudentMessSubscription;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HostelMessController extends Controller
{
    public function index()
    {
        $messes = HostelMess::withCount(['subscriptions' => function ($q) {
            $q->where('status', 'active');
        }])->latest()->paginate(10);

        return view('hostel-messes.index', compact('messes'));
    }

    public function create()
    {
        return view('hostel-messes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'warden_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        HostelMess::create($validated);

        return redirect()->route('hostel-messes.index')->with('success', 'Hostel mess created successfully.');
    }

    public function show(HostelMess $hostelMess)
    {
        $hostelMess->load(['menus', 'subscriptions.student']);
        
        // Structure menus by day and meal
        $menus = [];
        foreach ($hostelMess->menus as $menu) {
            $menus[$menu->day_of_week][$menu->meal_type] = $menu->menu_items;
        }

        // Get students who don't have active subscriptions
        $subbedStudentIds = StudentMessSubscription::where('status', 'active')->pluck('student_id');
        $students = Student::whereNotIn('id', $subbedStudentIds)->get();

        return view('hostel-messes.menu', compact('hostelMess', 'menus', 'students'));
    }

    public function updateMenu(Request $request, HostelMess $hostelMess)
    {
        $request->validate([
            'menu' => 'required|array',
        ]);

        foreach ($request->menu as $day => $meals) {
            foreach ($meals as $meal => $items) {
                if (!empty($items)) {
                    MessMenu::updateOrCreate(
                        [
                            'hostel_mess_id' => $hostelMess->id,
                            'day_of_week'    => $day,
                            'meal_type'      => $meal,
                        ],
                        ['menu_items' => $items]
                    );
                } else {
                    MessMenu::where('hostel_mess_id', $hostelMess->id)
                        ->where('day_of_week', $day)
                        ->where('meal_type', $meal)
                        ->delete();
                }
            }
        }

        return redirect()->route('hostel-messes.show', $hostelMess)->with('success', 'Mess menu updated successfully.');
    }

    public function subscribeStudent(Request $request, HostelMess $hostelMess)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        // Check if student already subscribed
        $existing = StudentMessSubscription::where('student_id', $validated['student_id'])
            ->where('status', 'active')
            ->first();

        if ($existing) {
            return back()->withErrors(['student_id' => 'This student is already subscribed to a mess.']);
        }

        StudentMessSubscription::create([
            'student_id'     => $validated['student_id'],
            'hostel_mess_id' => $hostelMess->id,
            'start_date'     => Carbon::today(),
            'status'         => 'active',
        ]);

        return redirect()->route('hostel-messes.show', $hostelMess)->with('success', 'Student subscribed to mess successfully.');
    }
}
