<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\GalleryMedia;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();
        
        $media = GalleryMedia::where('institute_id', $student->institute_id)
            ->where('status', true)
            ->with('uploader')
            ->latest()
            ->paginate(30);

        return view('student.gallery.index', compact('media'));
    }
}
