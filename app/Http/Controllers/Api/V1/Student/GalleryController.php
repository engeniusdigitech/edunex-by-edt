<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\GalleryMedia;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();
        
        $media = GalleryMedia::where('institute_id', $student->institute_id)
            ->where('status', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'photos' => $media->map(function ($m) {
                $caption = $m->caption ?? 'Untitled Event';
                
                $tag = 'Events';
                if (stripos($caption, 'sports') !== false) {
                    $tag = 'Sports';
                } elseif (stripos($caption, 'science') !== false || stripos($caption, 'physics') !== false || stripos($caption, 'chemistry') !== false || stripos($caption, 'lab') !== false) {
                    $tag = 'Science';
                } elseif (stripos($caption, 'class') !== false || stripos($caption, 'classroom') !== false || stripos($caption, 'study') !== false) {
                    $tag = 'Classroom';
                }

                return [
                    'id' => $m->id,
                    'url' => asset('storage/' . $m->file_path),
                    'title' => $caption,
                    'tag' => $tag,
                    'type' => $m->file_type,
                ];
            })
        ]);
    }
}
