<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;

class BatchController extends Controller
{
    public function index(Request $request)
    {
        $query = Batch::with('classTeacher');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%");
        }

        $batches = $query->latest()->paginate(15);

        return view('batches.index', compact('batches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'nullable|array',
            'start_time' => 'nullable|string',
            'end_time' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['institute_id'] = auth()->user()->institute_id;

        if (!empty($validated['days']) && !empty($validated['start_time']) && !empty($validated['end_time'])) {
            $start = \Carbon\Carbon::parse($validated['start_time'])->format('h:i A');
            $end = \Carbon\Carbon::parse($validated['end_time'])->format('h:i A');
            $validated['schedule_time'] = implode(', ', $validated['days']) . " ({$start} - {$end})";
        }
        else {
            $validated['schedule_time'] = null;
        }

        Batch::create($validated);

        return redirect()->route('batches.index')->with('success', 'Batch created successfully.');
    }

    public function update(Request $request, Batch $batch)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'days' => 'nullable|array',
            'start_time' => 'nullable|string',
            'end_time' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        if (!empty($validated['days']) && !empty($validated['start_time']) && !empty($validated['end_time'])) {
            $start = \Carbon\Carbon::parse($validated['start_time'])->format('h:i A');
            $end = \Carbon\Carbon::parse($validated['end_time'])->format('h:i A');
            $validated['schedule_time'] = implode(', ', $validated['days']) . " ({$start} - {$end})";
        }
        else {
            $validated['schedule_time'] = null;
        }

        $batch->update($validated);

        return redirect()->route('batches.index')->with('success', 'Batch updated successfully.');
    }

    public function destroy(Batch $batch)
    {
        $batch->delete();
        return redirect()->route('batches.index')->with('success', 'Batch deleted successfully.');
    }
}
