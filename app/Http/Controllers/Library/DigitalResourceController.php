<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\StoreDigitalResourceRequest;
use App\Models\Library\Book;
use App\Models\Library\DigitalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DigitalResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = DigitalResource::with('book');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('file_type')) {
            $query->where('file_type', $request->file_type);
        }

        $resources = $query->latest()->paginate(15);

        return view('library.digital-resources.index', compact('resources'));
    }

    public function create()
    {
        $books = Book::orderBy('title')->get();

        return view('library.digital-resources.create', compact('books'));
    }

    public function store(StoreDigitalResourceRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('library/digital', 'public');
            $data['file_size'] = $request->file('file')->getSize();
            $data['file_type'] = $request->file('file')->getClientOriginalExtension();
        }

        $data['institute_id'] = auth()->user()->institute_id;
        $data['uploaded_by'] = auth()->id();

        DigitalResource::create($data);

        return redirect()->route('library.digital-resources.index')
            ->with('success', 'Digital resource uploaded successfully.');
    }

    public function edit(DigitalResource $digitalResource)
    {
        $books = Book::orderBy('title')->get();

        return view('library.digital-resources.edit', compact('digitalResource', 'books'));
    }

    public function update(Request $request, DigitalResource $digitalResource)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'book_id' => 'nullable|exists:books,id',
            'access_roles' => 'nullable|array',
            'access_roles.*' => 'string|in:student,teacher,librarian,all',
            'file' => 'nullable|file|max:51200',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file
            if ($digitalResource->file_path) {
                Storage::disk('public')->delete($digitalResource->file_path);
            }

            $validated['file_path'] = $request->file('file')->store('library/digital', 'public');
            $validated['file_size'] = $request->file('file')->getSize();
            $validated['file_type'] = $request->file('file')->getClientOriginalExtension();
        }

        if (isset($validated['access_roles'])) {
            $validated['access_roles'] = json_encode($validated['access_roles']);
        }

        $digitalResource->update($validated);

        return redirect()->route('library.digital-resources.index')
            ->with('success', 'Digital resource updated successfully.');
    }

    public function destroy(DigitalResource $digitalResource)
    {
        if ($digitalResource->file_path) {
            Storage::disk('public')->delete($digitalResource->file_path);
        }

        $digitalResource->delete();

        return redirect()->route('library.digital-resources.index')
            ->with('success', 'Digital resource deleted successfully.');
    }

    public function download(DigitalResource $digitalResource)
    {
        if (!$digitalResource->file_path || !Storage::disk('public')->exists($digitalResource->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $digitalResource->increment('download_count');

        return Storage::disk('public')->download(
            $digitalResource->file_path,
            $digitalResource->title . '.' . $digitalResource->file_type
        );
    }

    public function preview(DigitalResource $digitalResource)
    {
        if (!$digitalResource->file_path || !Storage::disk('public')->exists($digitalResource->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        $filePath = Storage::disk('public')->path($digitalResource->file_path);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $digitalResource->title . '.pdf"',
        ]);
    }
}
