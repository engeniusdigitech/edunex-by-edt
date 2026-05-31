<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\UpdateSettingRequest;
use App\Models\Library\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::firstOrCreate(
            ['institute_id' => auth()->user()->institute_id],
            [
                'max_books_per_student' => 3,
                'max_books_per_staff' => 5,
                'issue_duration_days' => 14,
                'fine_per_day' => 1.00,
                'allow_renewal' => true,
                'max_renewals' => 2,
                'allow_reservation' => true,
                'max_reservations' => 3,
            ]
        );

        return view('library.settings.edit', compact('settings'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $settings = Setting::where('institute_id', auth()->user()->institute_id)->firstOrFail();
        $settings->update($request->validated());

        return redirect()->route('library.settings.edit')->with('success', 'Library settings updated successfully.');
    }
}
