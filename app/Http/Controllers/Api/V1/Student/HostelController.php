<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    public function studentHostel(Request $request)
    {
        $student = $request->user();
        $hostel = null;
        $room = null;
        $warden = null;
        $leaves = [];

        if (class_exists(\App\Models\HostelRoom::class)) {
            $allocation = \App\Models\HostelRoom::with(['hostel', 'warden'])
                ->whereHas('students', fn($q) => $q->where('student_id', $student->id))
                ->first();

            if ($allocation) {
                $hostel = [
                    'name' => $allocation->hostel?->name ?? 'Hostel',
                    'type' => $allocation->hostel?->type ?? null,
                ];
                $room = [
                    'number' => $allocation->room_number ?? $allocation->number,
                    'floor' => $allocation->floor ?? null,
                    'block' => $allocation->block ?? null,
                ];
                if ($allocation->warden) {
                    $warden = [
                        'name' => $allocation->warden->name,
                        'phone' => $allocation->warden->phone ?? null,
                    ];
                }
            }
        } elseif (property_exists($student, 'hostel_room_id') && $student->hostelRoom) {
            $hostel = ['name' => $student->hostelRoom->hostel->name ?? 'Hostel', 'type' => null];
            $room = ['number' => $student->hostelRoom->number, 'floor' => null, 'block' => null];
        }

        return response()->json([
            'hostel' => $hostel,
            'room' => $room,
            'warden' => $warden,
            'leaves' => $leaves,
        ]);
    }
}
