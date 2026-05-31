<?php

namespace App\Http\Controllers\Api\V1\Student;

use App\Http\Controllers\Controller;
use App\Models\DisciplineRecord;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();
        
        $records = DisciplineRecord::where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $pointsDeducted = $records->sum('points_deducted');
        $behaviorScore = max(0, 100 - $pointsDeducted);

        $rating = 'Excellent (A+)';
        if ($behaviorScore >= 95) {
            $rating = 'Excellent (A+)';
        } elseif ($behaviorScore >= 90) {
            $rating = 'Very Good (A)';
        } elseif ($behaviorScore >= 80) {
            $rating = 'Good (B)';
        } elseif ($behaviorScore >= 70) {
            $rating = 'Satisfactory (C)';
        } elseif ($behaviorScore >= 60) {
            $rating = 'Needs Improvement (D)';
        } else {
            $rating = 'Poor (F)';
        }

        return response()->json([
            'behavior_score' => $behaviorScore,
            'rating' => $rating,
            'records' => $records->map(function ($rec) {
                $category = 'Demerit';
                $pointsStr = "-{$rec->points_deducted} pts";
                
                $level = ucfirst($rec->issue_level);
                
                return [
                    'id' => $rec->id,
                    'title' => "Discipline Issue ({$level})",
                    'category' => $category,
                    'date' => $rec->created_at->format('d M Y'),
                    'points' => $pointsStr,
                    'desc' => $rec->reason,
                    'isPositive' => false,
                ];
            })
        ]);
    }
}
