<?php

namespace App\Http\Controllers;

use App\Services\GeoLocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstituteAttendanceSettingController extends Controller
{
    public function edit()
    {
        $institute = Auth::user()->institute;

        return view('institute.attendance_settings', compact('institute'));
    }

    public function update(Request $request, GeoLocationService $geo)
    {
        $institute = Auth::user()->institute;

        $validated = $request->validate([
            'address' => 'required|string|max:1000',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'attendance_radius_meters' => 'required|integer|min:50|max:5000',
            'auto_geocode' => 'nullable|boolean',
            'use_current_location' => 'nullable|boolean',
        ]);

        $latitude = $validated['latitude'] ?? null;
        $longitude = $validated['longitude'] ?? null;

        if ($request->boolean('use_current_location')) {
            if (!$latitude || !$longitude) {
                return back()->withInput()->withErrors([
                    'latitude' => 'Could not save current location. Please detect your location again or enter coordinates manually.',
                ]);
            }
        } elseif ($request->boolean('auto_geocode') || (!$latitude || !$longitude)) {
            $geocoded = $geo->geocodeAddress($validated['address']);
            if ($geocoded) {
                $latitude = $geocoded['latitude'];
                $longitude = $geocoded['longitude'];
            } elseif (!$latitude || !$longitude) {
                return back()->withInput()->withErrors([
                    'address' => 'Could not locate this address. Enter latitude and longitude manually or refine the address.',
                ]);
            }
        }

        $institute->update([
            'address' => $validated['address'],
            'latitude' => $latitude,
            'longitude' => $longitude,
            'attendance_radius_meters' => $validated['attendance_radius_meters'],
        ]);

        return redirect()->route('institute.attendance-settings.edit')
            ->with('success', 'Attendance location settings saved successfully.');
    }
}
