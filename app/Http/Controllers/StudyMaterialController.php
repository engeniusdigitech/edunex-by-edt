<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use App\Models\Batch;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudyMaterialController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = StudyMaterial::with(['batch', 'subject', 'uploader']);

        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id');
            $query->whereIn('batch_id', $batchIds);
            $batches = $user->batches()->where('is_active', true)->get();
        } else {
            $batches = Batch::where('is_active', true)->get();
        }

        if ($request->filled('batch_id')) {
            $query->where('batch_id', $request->batch_id);
        }

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        $studyMaterials = $query->latest()->paginate(15);
        
        // Fetch all active subjects to populate selection dropdown
        $subjects = Subject::where('is_active', true)->get();

        // Compute statistics for the view
        $totalFiles = StudyMaterial::count();
        $totalBytes = StudyMaterial::sum('file_size');
        $formattedStorage = '0 B';
        if ($totalBytes > 0) {
            $units = ['B', 'KB', 'MB', 'GB', 'TB'];
            $factor = floor(log($totalBytes, 1024));
            $factor = min($factor, count($units) - 1);
            $formattedStorage = round($totalBytes / pow(1024, $factor), 1) . ' ' . $units[$factor];
        }
        $totalDownloads = StudyMaterial::sum('download_count');
        
        if ($user->isTeacher()) {
            $totalBatches = $user->batches()->where('is_active', true)->count();
        } else {
            $totalBatches = Batch::where('is_active', true)->count();
        }

        return view('study-materials', compact(
            'studyMaterials', 
            'batches', 
            'subjects', 
            'totalFiles', 
            'formattedStorage', 
            'totalDownloads', 
            'totalBatches'
        ));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($request->batch_id, $batchIds)) {
                return back()->withErrors(['batch_id' => 'You can only upload study materials for your own batches.']);
            }
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'batch_id' => 'required|exists:batches,id',
            'file' => 'required|file|max:20480', // limit 20MB
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('study-materials', 'public');
            
            StudyMaterial::create([
                'title' => $request->title,
                'description' => $request->description,
                'subject_id' => $request->subject_id,
                'batch_id' => $request->batch_id,
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_type' => strtolower($file->getClientOriginalExtension() ?: 'bin'),
                'uploaded_by' => $user->id,
            ]);

            return redirect()->route('study-materials.index')
                ->with('success', 'Study Material uploaded successfully!');
        }

        return back()->withErrors(['file' => 'Failed to upload file.']);
    }

    public function destroy(StudyMaterial $studyMaterial)
    {
        $user = auth()->user();
        
        if ($user->isTeacher()) {
            $batchIds = $user->batches()->where('is_active', true)->pluck('batches.id')->toArray();
            if (!in_array($studyMaterial->batch_id, $batchIds)) {
                abort(403, 'Unauthorized.');
            }
        }

        // Delete file from disk
        if (Storage::disk('public')->exists($studyMaterial->file_path)) {
            Storage::disk('public')->delete($studyMaterial->file_path);
        }

        $studyMaterial->delete();

        return redirect()->route('study-materials.index')
            ->with('success', 'Study Material deleted successfully.');
    }

    public function studentIndex(Request $request)
    {
        $student = auth()->guard('student')->user();
        
        $query = StudyMaterial::with(['subject', 'uploader'])
            ->where('batch_id', $student->batch_id);

        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }

        $studyMaterials = $query->latest()->get();
        
        // Fetch subjects associated with student's batch
        $subjects = Subject::where('batch_id', $student->batch_id)
            ->where('is_active', true)
            ->get();
            
        // Fallback to all active subjects if none specifically assigned to batch
        if ($subjects->isEmpty()) {
            $subjects = Subject::where('is_active', true)->get();
        }

        return view('student.study-materials', compact('studyMaterials', 'subjects'));
    }

    public function download(StudyMaterial $studyMaterial)
    {
        // Increment download counter
        $studyMaterial->increment('download_count');

        // Deliver the file
        return Storage::disk('public')->download($studyMaterial->file_path, $studyMaterial->file_name);
    }
}
