<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\DisciplineRecord;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index()
    {
        $student = auth('student')->user();
        
        $records = DisciplineRecord::where('student_id', $student->id)
            ->with('reporter')
            ->latest()
            ->paginate(20);

        $totalDeductions = DisciplineRecord::where('student_id', $student->id)->sum('points_deducted');
        
        $score = 100 - $totalDeductions;
        if ($score < 0) $score = 0; // Floor at 0%

        return view('student.discipline.index', compact('records', 'score', 'totalDeductions'));
    }
}
