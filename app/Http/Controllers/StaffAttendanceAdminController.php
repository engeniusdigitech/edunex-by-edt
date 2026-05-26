<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\StaffAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class StaffAttendanceAdminController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->filled('date') ? $request->date('date') : today();

        $staffRoleIds = Role::whereIn('name', ['Teacher', 'Receptionist', 'Principal'])->pluck('id');

        $staffMembers = User::whereIn('role_id', $staffRoleIds)
            ->orderBy('name')
            ->get();

        $attendances = StaffAttendance::where('date', $date)
            ->whereIn('user_id', $staffMembers->pluck('id'))
            ->get()
            ->keyBy('user_id');

        return view('staff_attendance.admin_index', compact('staffMembers', 'attendances', 'date'));
    }
}
