<?php

namespace App\Http\Controllers;

use App\Models\GalleryMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryMediaController extends Controller
{
    public function index()
    {
        $media = GalleryMedia::with('uploader')->latest()->paginate(20);
        return view('gallery.index', compact('media'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // 20MB max
            'caption' => 'nullable|string|max:255',
        ]);

        $file = $request->file('file');
        $mime = $file->getMimeType();
        $type = str_contains($mime, 'video') ? 'video' : 'image';

        $path = $file->store('gallery', 'public');

        GalleryMedia::create([
            'institute_id' => auth()->user()->institute_id,
            'file_path' => $path,
            'file_type' => $type,
            'caption' => $request->caption,
            'uploaded_by' => auth()->id(),
            'status' => true,
        ]);

        return back()->with('success', 'Media uploaded to gallery successfully!');
    }

    public function destroy(GalleryMedia $gallery)
    {
        if ($gallery->file_path) {
            Storage::disk('public')->delete($gallery->file_path);
        }
        
        $gallery->delete();

        return back()->with('success', 'Media deleted successfully!');
    }
}
