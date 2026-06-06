<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\HostelAllocation;
use App\Models\HostelMess;
use App\Models\StudentMessSubscription;
use App\Models\MessMenu;
use App\Models\Student;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    private function student()
    {
        return auth()->guard('student')->user();
    }

    public function myRoom()
    {
        $student = $this->student();

        // Get active allocation
        $allocation = HostelAllocation::where('student_id', $student->id)
            ->where('status', 'active')
            ->with(['room.hostel'])
            ->first();

        $roommates = collect();
        if ($allocation) {
            // Get other students allocated to the same room
            $roommates = Student::whereHas('hostelAllocations', function ($q) use ($allocation) {
                $q->where('hostel_room_id', $allocation->hostel_room_id)
                  ->where('status', 'active');
            })->where('id', '!=', $student->id)->get();
        }

        return view('student.hostel.my-room', compact('allocation', 'roommates'));
    }

    public function messMenu()
    {
        $student = $this->student();

        // Find active mess subscription
        $sub = StudentMessSubscription::where('student_id', $student->id)
            ->where('status', 'active')
            ->with('mess')
            ->first();

        $menus = [];
        $mess = null;

        if ($sub) {
            $mess = $sub->mess;
            $messMenus = MessMenu::where('hostel_mess_id', $mess->id)->get();
            foreach ($messMenus as $menu) {
                $menus[$menu->day_of_week][$menu->meal_type] = $menu->menu_items;
            }
        }

        return view('student.hostel.mess-menu', compact('sub', 'mess', 'menus'));
    }
}
