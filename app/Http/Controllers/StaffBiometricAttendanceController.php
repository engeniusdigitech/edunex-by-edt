<?php

namespace App\Http\Controllers;

use App\Models\StaffAttendance;
use App\Services\FaceMatchService;
use App\Services\GeoLocationService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffBiometricAttendanceController extends Controller
{
    public function index()
    {
        $this->ensureCanUseBiometricAttendance();

        $user = Auth::user();
        $institute = $user->institute;
        $today = StaffAttendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => today()],
            ['status' => 'absent']
        );

        $recent = StaffAttendance::where('user_id', $user->id)
            ->orderByDesc('date')
            ->limit(14)
            ->get();

        $locationReady = $institute->latitude && $institute->longitude;
        $faceReady = !empty($user->face_descriptor);

        return view('staff_attendance.mark', compact('today', 'recent', 'institute', 'locationReady', 'faceReady'));
    }

    public function mark(Request $request, GeoLocationService $geo, FaceMatchService $faceMatch)
    {
        $this->ensureCanUseBiometricAttendance();

        $user = Auth::user();
        $institute = $user->institute;

        $validated = $request->validate([
            'action' => 'required|in:mark_in,mark_out',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'face_descriptor' => 'required|json',
        ]);

        if (!$user->face_descriptor) {
            return response()->json(['success' => false, 'message' => 'Face not enrolled. Contact admin to register your face.'], 422);
        }

        if (!$institute->latitude || !$institute->longitude) {
            return response()->json(['success' => false, 'message' => 'Institute location not configured by admin.'], 422);
        }

        $stored = is_array($user->face_descriptor)
            ? $user->face_descriptor
            : json_decode($user->face_descriptor, true);

        $live = json_decode($validated['face_descriptor'], true);
        if (isset($live['descriptor'])) {
            $live = $live['descriptor'];
        }

        $faceResult = $faceMatch->matches($stored, $live);
        if (!$faceResult['matched']) {
            return response()->json(['success' => false, 'message' => $faceResult['message']], 422);
        }

        $geoResult = $geo->isWithinInstituteRange(
            $institute,
            (float) $validated['latitude'],
            (float) $validated['longitude']
        );

        if (!$geoResult['allowed']) {
            return response()->json(['success' => false, 'message' => $geoResult['message']], 422);
        }

        $attendance = StaffAttendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => today()],
            ['status' => 'absent']
        );

        $action = $validated['action'];
        $now = Carbon::now();

        if ($action === 'mark_in') {
            if ($attendance->mark_in_at) {
                return response()->json(['success' => false, 'message' => 'Already marked in today at ' . $attendance->mark_in_at->format('h:i A')], 422);
            }

            $attendance->update([
                'mark_in_at' => $now,
                'mark_in_latitude' => $validated['latitude'],
                'mark_in_longitude' => $validated['longitude'],
                'mark_in_distance_meters' => $geoResult['distance'],
                'face_verified_in' => true,
                'status' => 'present',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Marked IN successfully at ' . $now->format('h:i A'),
                'action' => 'mark_in',
                'time' => $now->format('h:i A'),
            ]);
        }

        if (!$attendance->mark_in_at) {
            return response()->json(['success' => false, 'message' => 'Please mark IN before marking OUT.'], 422);
        }

        if ($attendance->mark_out_at) {
            return response()->json(['success' => false, 'message' => 'Already marked out today at ' . $attendance->mark_out_at->format('h:i A')], 422);
        }

        $attendance->update([
            'mark_out_at' => $now,
            'mark_out_latitude' => $validated['latitude'],
            'mark_out_longitude' => $validated['longitude'],
            'mark_out_distance_meters' => $geoResult['distance'],
            'face_verified_out' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Marked OUT successfully at ' . $now->format('h:i A'),
            'action' => 'mark_out',
            'time' => $now->format('h:i A'),
        ]);
    }

    protected function ensureCanUseBiometricAttendance(): void
    {
        if (!Auth::user()?->canUseBiometricAttendance()) {
            abort(403, 'Biometric attendance is only available for staff members.');
        }
    }
}
