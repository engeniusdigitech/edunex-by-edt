<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\StudyMaterial;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        $query = StudyMaterial::with(['subject', 'uploader'])
            ->where('batch_id', $student->batch_id);

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $materials = $query->latest()->get();

        // Get subjects that have materials for the student's batch
        $subjectIds = StudyMaterial::where('batch_id', $student->batch_id)
            ->whereNotNull('subject_id')
            ->pluck('subject_id')
            ->unique();

        $subjects = Subject::whereIn('id', $subjectIds)->orderBy('name')->get();

        return response()->json([
            'subjects' => $subjects->map(function ($subject) {
                return [
                    'id' => $subject->id,
                    'name' => $subject->name,
                ];
            })->values(),
            'materials' => $materials->map(function ($material) {
                return [
                    'id' => $material->id,
                    'title' => $material->title,
                    'description' => $material->description,
                    'subject_name' => $material->subject ? $material->subject->name : null,
                    'file_type' => $material->file_type,
                    'file_size' => $material->formatted_file_size,
                    'download_url' => $material->file_path ? Storage::url($material->file_path) : null,
                    'uploaded_by' => $material->uploader ? $material->uploader->name : null,
                    'created_at' => $material->created_at ? $material->created_at->format('Y-m-d H:i:s') : null,
                ];
            })->values(),
        ]);
    }
}
